# Cambios hechos en el proyecto

**En una frase:** el sitio ahora funciona 100% con Laravel y el patrón MVC. Los datos salen de la base de datos a través de los **modelos**, los **controladores** los preparan y las **vistas** Blade arman el HTML en el servidor. Ya no queda ningún archivo de JavaScript propio.

---

## ⚠️ Qué hacer después de bajar estos cambios

Si ya tenías el proyecto instalado, corre esto en orden:

```bash
composer install                   # se agregó Laravel Boost (herramienta de desarrollo)
php artisan migrate:fresh --seed   # borra y vuelve a crear la base (cambiaron las migraciones)
npm run build                      # o "npm run dev"; ahora solo compila el CSS
php artisan test                   # deben pasar las 44 pruebas
```

Y en tu `.env` agrega o cambia estas dos líneas (ya vienen así en `.env.example`):

```
APP_LOCALE=es
BOOST_BROWSER_LOGS_WATCHER=false
```

`migrate:fresh` borra todas las tablas y las vuelve a llenar con el catálogo de los seeders. Solo se pierden los datos que hayas creado a mano (usuarios de prueba o mensajes de contacto).

---

## 1. Por qué antes no era MVC de verdad

| Capa | Cómo estaba | El problema |
| --- | --- | --- |
| **Modelo** | Existían `Product`, `Category`, etc., pero la consulta la hacía un *View Composer* en `AppServiceProvider` | Pedía los 38 productos con sus specs en **todas** las páginas, se usaran o no |
| **Controlador** | Casi todos solo hacían `return view('...')` | No decidían nada: no pedían datos ni procesaban formularios |
| **Vista** | Las vistas eran cascarones vacíos (`<div id="productsGrid"></div>`) | El HTML de los productos lo armaba `script.js` en el navegador, a partir de `window.PRODUCTS` |

Además, los formularios de login, registro y contacto eran de mentira (mostraban "Formulario de ejemplo") y el carrito tenía dos productos escritos a mano.

## 2. Cómo funciona ahora: el recorrido de una página

Ejemplo: un cliente abre `/productos?categoria=gpu`.

1. **Ruta** (`routes/web.php`): `/productos` le corresponde a `ProductoController@index`.
2. **Controlador** (`app/Http/Controllers/ProductoController.php`): lee el filtro `categoria=gpu` y le pide al modelo los productos activos de esa categoría.
3. **Modelo** (`app/Models/Product.php`): hace la consulta con Eloquent (`Product::active()->...`) y devuelve los productos con su marca.
4. **Vista** (`resources/views/productos.blade.php`): recorre los productos con `@foreach` y dibuja cada tarjeta con el componente `<x-product-card>`.

El navegador recibe el HTML ya terminado. No hay que esperar a que corra ningún script.

| Página | Controlador | Modelo(s) | Vista |
| --- | --- | --- | --- |
| Inicio | `InicioController@index` | `Category`, `Product` (destacados) | `index` |
| Catálogo | `ProductoController@index` | `Product`, `Category` | `productos` |
| Ficha de producto | `ProductoController@show` | `Product` (+ marca, categoría, specs) | `producto` |
| Ofertas | `OfertasController@index` | `Product` (rebajados) | `ofertas` |
| Carrito | `CarritoController` | `Product` + la sesión | `carrito` |
| Contacto | `ContactoController` | `ContactMessage` (nuevo) | `contacto` |
| Login / salir | `LoginController` | `User` | `login` |
| Registro | `RegistroController` (antes `NuevouController`) | `User` | `registro` (antes `nuevou`) |
| Nosotros, Garantía, Cambios, Pago seguro, FAQ | Ninguno: `Route::view` | Ninguno | Su vista |

**Sobre las páginas informativas:** no consultan datos, así que no necesitan un controlador propio. `Route::view('/faq', 'faq')` es la forma oficial de Laravel para eso; por dentro usa su propio controlador interno. Si el profesor pide un controlador por página, volver a crearlos es trivial.

## 3. Archivos eliminados (la purga)

| Qué se borró | Por qué |
| --- | --- |
| `CategoriasController`, `UsuariosController` y sus vistas | Eran ejercicios de clase sueltos ("u1, u2, u3") y además daban **error 500** (ver errores 1) |
| `AyudaController` y `ayuda.blade.php` | La vista estaba vacía y ningún link llevaba ahí |
| `FaqController`, `GarantiaController`, `NosotrosController`, `Cambios_devolucionesController`, `Pago_seguroController` | Solo devolvían una vista; los reemplaza `Route::view` |
| `ProductosController` | Se unió con `ProductoController` (`index` para el catálogo, `show` para la ficha), como pide la convención de Laravel |
| `NuevouController` | Reemplazado por `RegistroController`, que ahora sí crea la cuenta |
| `resources/js/` completo (`app.js`, `script.js`, `products.js`, `producto.js`) | Todo lo que hacían ahora lo hace Laravel (ver sección 4) |
| Modelo `ProductImage`, su migración y su seeder | Ninguna página usaba esa tabla, y el seeder apuntaba a fotos que no existen (`ACIRA_2.webp`, `ACIRA_3.webp`) |
| Migración `add_badge_featured_old_price_to_products_table` | Se fusionó con `create_products_table`: el proyecto no está publicado, así que no hace falta una migración aparte para tres columnas |
| `tests/Unit/ExampleTest.php`, `tests/Feature/ExampleTest.php` | Pruebas de ejemplo de Laravel; las reemplazan las 44 pruebas reales |
| `public/images/logo/logo-la-virgo-cueva.png`, `public/images/procesadores/PROCESADORES_EN_PROMO_2.webp` | Ninguna página las usaba. Si las necesitas: `git checkout HEAD -- <ruta>` |
| CSS sin uso: testimonios, `.blob`, `.about__stats`, `.divider`, `.form-message`, `.hero__video` | Ninguna vista tenía esas clases |
| Fuente "Instrument Sans" (en `vite.config.js` y `app.css`) | Venía con la plantilla de Laravel pero el sitio nunca la mostraba; solo agregaba 6 archivos de fuentes al build |

Los parciales de `resources/views/indexbox/` y `inicio.blade.php` ya se habían quitado antes de esta ronda.

## 4. Qué reemplazó a cada parte del JavaScript

| Función | Antes (JS) | Ahora (Laravel / HTML) |
| --- | --- | --- |
| Tarjetas de productos | `script.js` armaba el HTML con `innerHTML` | Blade, con el componente `resources/views/components/product-card.blade.php` |
| Filtro por categoría | Botones que filtraban un array en el navegador | Enlaces `/productos?categoria=teclados`; filtra el controlador con una consulta |
| Ficha de producto | `producto.js` leía `?id=` y llenaba la página | Ruta `/productos/{slug}`: Laravel busca el producto por su slug (*route model binding*) y da 404 si no existe |
| Productos relacionados | Filtro en JS | Consulta en el controlador: misma categoría, máximo 4 |
| Cuenta regresiva | Contaba en vivo cada segundo | La calcula el servidor al cargar la página; no corre sola, se actualiza al recargar |
| Preguntas frecuentes | Acordeón con JS | Etiquetas `<details>` y `<summary>`: el navegador las abre y cierra solo |
| Menú hamburguesa (celular) | JS agregaba la clase `is-open` | Un checkbox oculto y CSS: el ícono es un `<label>` que lo activa |
| Carrito | Lista fija con botones + y − hechos en JS | Carrito real guardado en la sesión de Laravel, con formularios (ver sección 5) |
| Login y registro | Mostraban "Formulario de ejemplo" | Autenticación real de Laravel |
| Formato de precios (`formatCOP`) | Función JS | Componente `<x-precio>`: `$1.234.900` |

## 5. Funciones que antes eran de mentira y ahora funcionan

- **Carrito.** "Agregar al carrito" en la ficha guarda el producto en la sesión. En `/carrito` se puede sumar, restar o eliminar; el subtotal, el envío ($17.900 fijo) y el total los calcula el servidor. No deja pedir más unidades que el stock, y el ícono del header muestra la cantidad real (antes decía "2" siempre).
- **Cuentas de usuario.** El registro crea el usuario con la contraseña encriptada e inicia sesión. El login tiene "Recordarme" y se bloquea un minuto después de 5 intentos fallidos. Con la sesión iniciada, arriba aparece "Hola, Nombre · Cerrar sesión".
- **Formulario de contacto.** Valida los datos y guarda cada mensaje en la tabla nueva `contact_messages` (modelo `ContactMessage`). Se pueden ver en phpMyAdmin o con `php artisan tinker` → `App\Models\ContactMessage::latest()->get()`.
- **Buscador.** La lupa del header antes no hacía nada. Ahora abre un campo que busca por nombre, descripción o marca (`/productos?buscar=razer`) y se puede combinar con el filtro de categoría.
- **Página de ofertas.** Antes solo mostraba la cuenta regresiva, sin ningún producto. Ahora lista los productos rebajados (los que tienen precio anterior).
- **Página 404 propia.** Un producto o página que no existe muestra "No encontramos lo que buscas" con el diseño de la tienda, en vez de la página genérica de Laravel en inglés.
- **Mensajes en español.** Los errores de los formularios ("El campo correo es obligatorio.") salen de `lang/es/validation.php` y `lang/es/auth.php`.

## 6. Errores corregidos

1. **`/categorias` y `/usuarios` daban error 500.** La ruta llamaba a métodos `categorias()` y `usuarios()`, pero los controladores tenían `index()`. Se eliminaron (sección 3).
2. **`/cambios_devoluciones` daba error 500 en Linux.** El controlador pedía `view('Cambios_devoluciones')` con C mayúscula y el archivo es `cambios_devoluciones.blade.php`. En Windows (XAMPP) funcionaba porque Windows no distingue mayúsculas de minúsculas; Linux sí.
3. **Al comentar los imports de `app.js` se rompieron varias páginas.** "Lo más pedido" de la portada quedó vacío, la ficha de producto también, y dejaron de funcionar los filtros, la FAQ, la cuenta regresiva y el carrito. Todo eso ahora lo hace Laravel (sección 4).
4. **Errores en la grilla de `productos.blade.php`:**
   - Las imágenes no cargaban: `asset('public' . ...)` generaba `/public/images/...`, una ruta que no existe.
   - `data-category` usaba el nombre ("Tarjetas de video") en vez del slug (`gpu`), así que los filtros no coincidían.
   - Los links usaban el id numérico (`?id=5`), pero la ficha buscaba por slug y mostraba "no encontrado".
   - La etiqueta ("Nuevo", "Oferta") salía como texto suelto, sin estilo.
   - Se usaba la clase `old-price`, que no existe en el CSS (la correcta es `product-card__price-old`).
   - No se filtraban los productos inactivos.
5. **La cuenta regresiva ya había vencido.** Tenía fija la fecha 30-sep-2026, así que solo mostraba "La oferta ya terminó". Ahora cuenta hasta el domingo a medianoche de cada semana, que coincide con el título "Ofertas de la semana".
6. **La fuente de los títulos (Space Grotesk) nunca cargaba.** El `@import` estaba en medio de `app.css` y el compilador lo descartaba. Ahora se carga con un `<link>` en el layout.
7. **El menú del celular nunca se veía, ni siquiera con el JS.** El header tiene `backdrop-filter`, y eso hace que un menú con `position: fixed` quede encerrado dentro del header (con alto cero). Ahora el menú se ubica justo debajo del header.
8. **Contacto:**
   - La imagen del mapa tenía el atributo `src` sin cerrar comillas.
   - El archivo `mapa-ubicacion.jpg` no existe.
   - Se reemplazó por un mapa de Google Maps embebido con la dirección de la tienda.
9. **Nosotros:** la foto `nosotros-equipo.jpg` no existe. Mientras tanto se muestra el logo en una tarjeta (ver pendientes).
10. **Once páginas no tenían título en la pestaña del navegador** (salía " | Virgo Cueva"). Ahora cada vista define el suyo; la ficha usa el nombre del producto.
11. **Consulta innecesaria en todas las páginas.** El *View Composer* cargaba los 38 productos con sus 175 specs en cada página, incluso en "Garantía". Se eliminó; ahora cada controlador pide solo lo que necesita.
12. **Riesgo de seguridad (XSS).** El JS metía los datos con `innerHTML` sin escaparlos. Blade escapa todo lo que imprime con `{{ }}`, y hay una prueba que lo verifica con el buscador. Todos los formularios llevan `@csrf`.
13. **`.env.example` estaba borrado.** Lo necesitan `instalacion.md` y el script `composer setup`. Se restauró, con `APP_LOCALE=es`.
14. **Detalles del layout:**
    - El favicon se declaraba como `image/x-icon` siendo un PNG.
    - El `src` del logo tenía un espacio al inicio.
    - Los links estaban escritos a mano (`href="/contacto"`); ahora todos usan rutas con nombre (`route('contacto')`).

## 7. Base de datos

- **Migraciones:**
  - `create_products_table` ahora incluye `badge`, `featured` y `old_price`.
  - Se quitó `product_images`.
  - Se agregó `create_contact_messages_table` (nombre, correo, motivo, mensaje).
- **Modelos:**
  - Relaciones con su tipo (`BelongsTo`, `HasMany`).
  - *Casts*: precios como enteros, porque el peso colombiano no maneja centavos, y `featured` e `is_active` como verdadero/falso.
  - Tres *scopes* reutilizables en `Product`: `active()`, `featured()` y `onSale()`.
- **Seeders:**
  - Cada categoría tiene su imagen, que es la que muestra la portada en "¿Qué andas buscando?".
  - Se quitó `ProductImageSeeder`.
  - Se revisó que las 38 imágenes de los seeders existan en `public/images`.
- **Factories:** `Category`, `Brand`, `Product`, `ProductSpec` y `ContactMessage`, para crear datos de prueba en los tests.

Resultado de `migrate:fresh --seed`: 8 categorías, 19 marcas, 38 productos (4 destacados, 6 en oferta) y 175 especificaciones.

## 8. Rutas finales

| URL | Método | Nombre | Quién responde |
| --- | --- | --- | --- |
| `/` | GET | `inicio` | `InicioController@index` |
| `/productos` | GET | `productos.index` | `ProductoController@index` |
| `/productos/{slug}` | GET | `productos.show` | `ProductoController@show` |
| `/ofertas` | GET | `ofertas` | `OfertasController@index` |
| `/carrito` | GET | `carrito.index` | `CarritoController@index` |
| `/carrito/{slug}` | POST / PATCH / DELETE | `carrito.store` / `carrito.update` / `carrito.destroy` | `CarritoController` |
| `/contacto` | GET / POST | `contacto` | `ContactoController@create` / `@store` |
| `/login` | GET / POST | `login` | `LoginController` (solo sin sesión) |
| `/registro` | GET / POST | `registro` | `RegistroController` (solo sin sesión) |
| `/logout` | POST | `logout` | `LoginController@destroy` (solo con sesión) |
| `/nosotros`, `/garantia`, `/cambios_devoluciones`, `/pago_seguro`, `/faq` | GET | Igual que la URL | `Route::view` |

Cambiaron tres URLs: `/producto?id=acira` ahora es `/productos/acira`, `/nuevou` ahora es `/registro` y `/productos#teclados` ahora es `/productos?categoria=teclados`.

## 9. Pruebas automáticas

Hay 44 pruebas en `tests/Feature/` (`php artisan test`). Usan una base SQLite en memoria, así que **no tocan tu base MySQL**. Cubren:

- Que el catálogo, la portada y las ofertas muestren solo productos activos.
- Los filtros, la búsqueda y la ficha de producto, incluido el 404.
- Todo el carrito: agregar, el límite de stock, cambiar cantidad, eliminar y los totales.
- El registro, el login, el bloqueo tras 5 intentos y el cierre de sesión.
- El formulario de contacto y sus mensajes de error en español.
- Las páginas informativas.

## 10. Herramientas

- **Laravel Boost** quedó instalado como dependencia de desarrollo, porque así lo pedía el `CLAUDE.md` del proyecto. Agrega guías para asistentes de IA (`CLAUDE.md`, `AGENTS.md`, `.claude/skills/`, `.mcp.json`, `boost.json`) y no afecta al sitio. Por defecto inyectaba un script en cada página para registrar errores del navegador; se desactivó con `BOOST_BROWSER_LOGS_WATCHER=false`.
- Mientras corre `npm run dev`, el HTML trae un único `<script>`, el de Vite (`@vite/client`), que recarga la página al guardar cambios. Con `npm run build` (producción) no hay ningún `<script>`.

## 11. Pendientes

Estas cosas no se pudieron dejar funcionando porque dependen de servicios o contenido que el proyecto no tiene:

- **"Ir a pagar":** no hay pasarela de pagos ni tabla de pedidos. El botón quedó deshabilitado con el aviso "El pago en línea todavía no está disponible". La página de login y la FAQ mencionan un "historial de pedidos" que todavía no existe.
- **"Continuar con Google":** se quitó. Necesita credenciales de Google y el paquete Laravel Socialite.
- **"¿Olvidaste tu contraseña?":** se quitó, porque los correos todavía no se envían (`MAIL_MAILER=log` los escribe en `storage/logs/laravel.log`). La respuesta de la FAQ ahora dice que escriban por contacto.
- **Foto del equipo en "Nosotros":** basta con poner la foto en `public/images/` y cambiar el `src` en `nosotros.blade.php`.
- **Redes sociales y términos y condiciones:** los links IG, TT, WA y "términos y condiciones" siguen apuntando a `#`.
