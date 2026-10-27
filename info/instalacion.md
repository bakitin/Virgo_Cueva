# Cómo levantar este proyecto después de clonarlo

Guía paso a paso para dejar el sitio corriendo en una máquina nueva (Windows + XAMPP). Seguir los pasos en orden.

## Requisitos previos

- **XAMPP** instalado (trae PHP 8.3+ y MySQL). Si no lo tenés: https://www.apachefriends.org
- **Composer** instalado (`composer -V` debe funcionar en la terminal).
- **Node.js + npm** instalado (`node -v` y `npm -v` deben funcionar).

## 1. Clonar el repo e instalar dependencias

```bash
git clone https://github.com/bakitin/Virgo_Cueva
cd Virgo_Cueva

composer install
npm install
```

## 2. Crear el archivo de entorno

```bash
copy .env.example .env
php artisan key:generate
```

Abrir `.env` y dejar el bloque de base de datos así (por defecto viene apuntando a sqlite, hay que cambiarlo a mysql):

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=virgocuevadb
DB_USERNAME=root
DB_PASSWORD=
```

## 3. Habilitar MySQL en el PHP de XAMPP

Por defecto, el PHP que trae XAMPP viene con las extensiones de MySQL **desactivadas**. Sin este paso, cualquier comando de `artisan` que toque la base de datos falla con `could not find driver`.

Abrir `C:\xampp\php\php.ini`, buscar estas dos líneas y sacarles el `;` de adelante:

```
extension=mysqli
extension=pdo_mysql
```

(Si el proyecto está en otra ruta de XAMPP, ajustar la ruta del `php.ini` en consecuencia.)

## 4. Levantar MySQL y crear la base de datos

1. Abrir el **XAMPP Control Panel** y darle **Start** a **MySQL** (dejarlo corriendo mientras se trabaja en el proyecto).
2. Crear la base de datos vacía. Cualquiera de las dos formas sirve:
   - **phpMyAdmin** (`http://localhost/phpmyadmin`): crear una base nueva llamada `virgocuevadb`.
   - **Consola**:
     ```bash
     "C:\xampp\mysql\bin\mysql.exe" -u root -e "CREATE DATABASE IF NOT EXISTS virgocuevadb CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
     ```

## 5. Migrar y poblar la base de datos

```bash
php artisan migrate --seed
```

Esto crea todas las tablas y las llena con el catálogo completo (categorías, marcas, productos y especificaciones) y el usuario administrador (`admin@lavirgocueva.co` / `admin`).

## 6. Compilar los assets del frontend (CSS)

Para desarrollo, dejar corriendo en una terminal aparte (recarga automática al guardar cambios):

```bash
npm run dev
```

O, si solo se quiere ver el sitio sin trabajar en el frontend, compilar una sola vez:

```bash
npm run build
```

## 7. Levantar el servidor de Laravel

En otra terminal:

```bash
php artisan serve
```

## 8. Abrir el sitio

```
http://127.0.0.1:8000
```

---

## Resumen (todos los comandos, uno atrás del otro)

Asumiendo que ya se editó `.env` (paso 2) y `php.ini` (paso 3), y que MySQL de XAMPP ya está prendido:

```bash
composer install
npm install
php artisan key:generate
php artisan migrate --seed
npm run build
php artisan serve
```

## API: autenticación y administración de productos

La aplicación tiene dos formas de autenticación independientes:

- **Sitio web y panel Blade:** se usa `/login`, que crea una sesión mediante cookies. Es el acceso normal desde el navegador.
- **API:** se usa `/api/login`, que devuelve un token de Sanctum para Postman, aplicaciones móviles o cualquier cliente externo.

El `LoginController` sirve el login web. El `ApiAuthController` sirve el login de la API. El token de la API no se obtiene desde el formulario `/login`.

### Requisitos de la API

Antes de probar los endpoints:

1. MySQL debe estar iniciado.
2. La base de datos debe existir.
3. Las migraciones deben estar ejecutadas:

```bash
php artisan migrate
```

La migración `create_personal_access_tokens_table` es obligatoria para que Sanctum pueda guardar los tokens. Si aparece el error:

```text
Table 'virgocuevadb.personal_access_tokens' doesn't exist
```

ejecuta:

```bash
php artisan migrate
```

Levanta Laravel con:

```bash
php artisan serve
```

La URL base local será:

```text
http://127.0.0.1:8000
```

## 1. Obtener el token de acceso

En Postman crea una petición:

```http
POST http://127.0.0.1:8000/api/login
```

En **Headers** agrega:

| Key | Value |
| --- | --- |
| `Accept` | `application/json` |
| `Content-Type` | `application/json` |

En **Body** selecciona:

```text
raw → JSON
```

Envía las credenciales del administrador:

```json
{
    "email": "admin@lavirgocueva.co",
    "password": "admin"
}
```

Estas son las credenciales creadas por `AdminUserSeeder`. La cuenta debe tener `is_admin = true` para poder utilizar el CRUD administrativo.

Una respuesta correcta se parece a:

```json
{
    "token": "1|abcdef123456...",
    "user": {
        "id": 1,
        "name": "Administrador",
        "email": "admin@lavirgocueva.co"
    }
}
```

Guarda el valor completo de `token`. No incluyas comillas y no copies solamente la parte después de `|`.

### Usar el token

Para cualquier endpoint protegido, en Postman abre **Authorization**, selecciona **Bearer** y pega el token en el campo **Token**. Postman enviará automáticamente el encabezado `Authorization` con el token de acceso.

No agregues `Authorization` al solicitar `/api/login`; ese endpoint es el que genera el token.

## 2. Consultas públicas

Estas peticiones no necesitan token:

| Método | URL | Descripción |
| --- | --- | --- |
| `GET` | `/api/productos` | Lista productos activos |
| `GET` | `/api/productos/{slug}` | Devuelve el detalle de un producto activo |
| `GET` | `/api/categorias` | Lista categorías |
| `GET` | `/api/marcas` | Lista marcas |

El catálogo admite filtros:

```http
GET /api/productos?categoria=gpu&buscar=razer
```

## 3. Listar productos del panel

Con el token de acceso del administrador:

```http
GET http://127.0.0.1:8000/api/admin/productos
```

Devuelve todos los productos, incluidos los ocultos, con su categoría y marca.

Este endpoint está protegido por:

- `auth:sanctum`
- `can:administrar`

Un usuario sin sesión/token recibe `401`. Un usuario autenticado que no sea administrador recibe `403`.

## 4. Crear un producto

Petición:

```http
POST http://127.0.0.1:8000/api/admin/productos
```

En **Authorization** selecciona `Bearer` y pega el token del administrador.

En **Body** selecciona:

```text
raw → JSON
```

No se cargan archivos. El campo `image` es una ruta de texto que ya debe existir en `public/`.

Campos:

| Campo | Tipo en Postman | Obligatorio | Descripción |
| --- | --- | --- | --- |
| `category_id` | Text | Sí | Id de una categoría existente |
| `brand_id` | Text | Sí | Id de una marca existente |
| `name` | Text | Sí | Nombre, máximo 150 caracteres |
| `slug` | Text | No | Si se deja vacío se genera desde el nombre |
| `price` | Text | Sí | Precio entero mayor que cero |
| `old_price` | Text | No | Debe ser mayor que `price` |
| `stock` | Text | Sí | Entero mayor o igual a cero |
| `badge` | Text | No | Etiqueta del producto |
| `short_description` | Text | No | Máximo 255 caracteres |
| `description` | Text | No | Máximo 5000 caracteres |
| `specs` | Text | No | Una especificación por línea |
| `is_active` | Text | No | `1` visible, `0` oculto |
| `featured` | Text | No | `1` destacado, `0` no destacado |
| `image` | Text | Sí | Ruta pública de una imagen existente, por ejemplo `/images/teclados/ACIRA_1.webp` |

Ejemplo de valores:

```text
category_id: 1
brand_id: 2
name: Teclado mecánico API
slug: teclado-mecanico-api
price: 250000
old_price: 300000
stock: 10
short_description: Teclado mecánico con iluminación RGB.
description: Descripción completa del producto.
specs: Switches rojos
RGB
87 teclas
is_active: 1
featured: 0
image: /images/teclados/ACIRA_1.webp
```

La respuesta correcta es `201 Created` y devuelve el producto creado:

```json
{
    "data": {
        "id": 39,
        "name": "Teclado mecánico API",
        "slug": "teclado-mecanico-api"
    }
}
```

## 5. Editar un producto

Petición:

```http
PUT http://127.0.0.1:8000/api/admin/productos/{id}
```

Ejemplo:

```http
PUT http://127.0.0.1:8000/api/admin/productos/39
```

Usa el mismo token de acceso y los mismos campos del formulario de creación. En la edición:

- `image` es opcional.
- Si no envías una imagen, se conserva la actual.
- Si envías una ruta nueva, se guarda esa ruta y no se modifica ningún archivo.
- `specs` reemplaza las especificaciones anteriores.

Envía el cuerpo como JSON (`raw → JSON`). La ruta debe ser una cadena, no un archivo.

La respuesta correcta es `200 OK`.

## 6. Eliminar un producto

Petición:

```http
DELETE http://127.0.0.1:8000/api/admin/productos/{id}
```

Ejemplo:

```http
DELETE http://127.0.0.1:8000/api/admin/productos/39
```

Usa el token de acceso del administrador. No necesita Body.

La respuesta correcta es:

```text
204 No Content
```

Al eliminar también se eliminan las especificaciones relacionadas. La ruta de imagen guardada en la base de datos no elimina ningún archivo físico.

## 7. Cerrar sesión de la API

Petición:

```http
POST http://127.0.0.1:8000/api/logout
```

Debe incluir el token de acceso. La petición revoca únicamente el token actual.

Respuesta:

```json
{
    "message": "Sesión API cerrada correctamente."
}
```

Después de cerrar sesión, ese token ya no debe utilizarse.

## 8. Errores frecuentes de Postman

### `El campo correo es obligatorio`

En **Body** se seleccionó `raw → Text` o se envió un formato distinto de JSON. Selecciona `raw → JSON` y verifica:

```http
Content-Type: application/json
```

### `Too Many Attempts`

Es una limitación temporal del login. Si aparece después de varios intentos, limpia la caché y reinicia el servidor:

```bash
php artisan optimize:clear
php artisan serve
```

### `personal_access_tokens doesn't exist`

Falta ejecutar la migración de Sanctum:

```bash
php artisan migrate
```

### `401 Unauthenticated`

Falta el token de acceso, está incompleto o fue revocado en `/api/logout`.

### `403 This action is unauthorized`

El token pertenece a un usuario válido, pero ese usuario no tiene `is_admin = true`.

### Error de validación al crear o editar

Revisa que la categoría y la marca existan, que `old_price` sea mayor que `price`, que `stock` sea un entero no negativo y que `image` sea una ruta de texto de máximo 255 caracteres.
