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

Esto crea todas las tablas y las llena con el catálogo completo (categorías, marcas, productos y especificaciones).

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
