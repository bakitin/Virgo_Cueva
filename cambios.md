# Cambios hechos en el proyecto

## 1. Como se conectaron los scripts

**Qué se hizo:**
- Se creó un archivo nuevo, `resources/js/app.js`, que es el que "enchufa" los tres scripts.
- Se agregó esa conexión en la plantilla principal (`layouts/app.blade.php linea 14`), que es el molde que usan todas las páginas del sitio.
- Como los tres archivos se pasan datos entre sí (por ejemplo, `script.js` necesita la lista de productos que vive en `products.js`), hubo que decirle a cada uno explícitamente "esto lo comparto" (`export`) y "esto lo uso de otro archivo" (`import`).

Resultado: el menú hamburguesa, las grillas de productos, el acordeón de preguntas frecuentes, la cuenta regresiva de ofertas y el carrito ya funcionan.

## 2. Las fotos de los productos no aparecían

En `products.js`, cada producto tenía su foto apuntando a una carpeta que no existe en el proyecto (`assets/...`). Las fotos de verdad están guardadas en `public/images/...`. Era literalmente una dirección mal escrita.

**Qué se hizo:** se corrigió la dirección de las 26 fotos para que apunten a donde realmente están (`public/images/...`). Se revisó nombre por nombre que cada foto exista ahí.

También encontré este mismo error (fotos apuntando a una carpeta que no existe) escondido en otros 3 lugares del sitio: la sección de categorías de la portada, el banner de ofertas de la portada, y las dos fotos de ejemplo en el carrito. Se corrigieron también.

## 3. Un montón de links llevaban a páginas que no existen

El sitio antes era HTML puro (páginas sueltas tipo `productos.html`, `contacto.html`, etc.) y se está convirtiendo a Laravel, que usa "rutas" en vez de archivos (`/productos`, `/contacto`). El problema es que quedaron muchos botones y links todavía escritos a la manera vieja, apuntando a páginas `.html` que ya no existen en este proyecto. Si un cliente hacía clic, le salía error 404 (página no encontrada).

**Qué se hizo:** se revisó todo el sitio y se cambiaron esos links viejos por las rutas reales de Laravel. Esto afectó, entre otros:
- Los botones "Ver productos", "Ver ofertas" de la portada.
- Las tarjetas de categorías (Teclados, Mouses, Audio, etc.) de la portada.
- Los links de "Garantía", "Pago seguro", "Cambios y devoluciones", "Contacto" que aparecen repetidos en varias páginas (beneficios, preguntas frecuentes, políticas).
- Los links entre "Iniciar sesión" y "Crear cuenta".
- El botón "Ver producto" y la foto de cada producto en las grillas (los generaba el propio `script.js`, así que el arreglo fue ahí).

## 4. Faltaba la página de "detalle de producto"

Cuando el cliente hace clic en un producto, se supone que debería llevarlo a una página con toda la info de ese producto (foto grande, descripción, precio, especificaciones, productos relacionados). El archivo `producto.js` ya tenía toda la lógica lista para llenar esa página... pero la página en sí nunca se había creado.

**Qué se hizo:** se creó esa página nueva (`/producto`), junto con su controlador (la piecita de Laravel que decide qué mostrar) y su plantilla visual, usando estilos que ya estaban preparados en el CSS del proyecto pero que nadie usaba todavía. Ahora, al hacer clic en cualquier producto, se abre su ficha completa con productos relacionados de la misma categoría al final.

## 5. Los productos vivían escritos a mano en el JS, ahora salen de la base de datos

`products.js` tenía los 38 productos del catálogo escritos directamente en el código, como un diccionario fijo. Eso significa que para agregar, editar o quitar un producto había que tocar código JavaScript a mano. La idea de esta parte era que esos productos vivan en la base de datos (con sus tablas `categories`, `brands`, `products`, `product_specs` que ya existían pero vacías) y que el sitio los muestre desde ahí, sin que `script.js` ni `producto.js` (los que dibujan las tarjetas y la página de detalle) tengan que cambiar ni una línea.

**a) La base de datos no tenía todo lo que el sitio necesitaba**

Las tablas ya existían (migraciones y modelos `Category`, `Brand`, `Product`, `ProductSpec`, `ProductImage`), pero a la tabla `products` le faltaban tres columnas que el sitio sí usa: `badge` (la etiqueta "Nuevo", "Premium", etc.), `featured` (si sale en la sección de destacados) y `old_price` (el precio anterior, para mostrar ofertas). Se agregó una migración nueva con esas tres columnas.

También se agregaron las relaciones entre modelos que faltaban (`Product` pertenece a una `Category` y a una `Brand`, y tiene muchas `ProductSpec`), necesarias para poder pedirle a un producto sus datos relacionados de una sola vez.

**b) Se llenaron los seeders con el catálogo real**

Los seeders (`CategorySeeder`, `BrandSeeder`, `ProductSeeder`, `ProductSpecSeeder`) tenían solo 1-3 productos de ejemplo, que ni coincidían con las categorías y marcas reales del sitio. Se reescribieron transcribiendo uno por uno los 38 productos, 8 categorías, 19 marcas y 175 especificaciones que estaban en `products.js`, para que la base de datos termine con exactamente el mismo catálogo que se veía antes a mano.

**c) La conexión a MySQL de XAMPP estaba apagada, literalmente**

Al intentar correr las migraciones, PHP tiraba error de "driver no encontrado". La causa: en `C:\xampp\php\php.ini` las líneas `extension=mysqli` y `extension=pdo_mysql` estaban comentadas (desactivadas), así que PHP ni sabía hablar con MySQL. Se descomentaron esas dos líneas, se arrancó el servicio MySQL de XAMPP (estaba apagado) y se creó la base `virgocuevadb`. Después de eso, `php artisan migrate --seed` corrió sin errores y se verificó en la base que quedaron las 8 categorías, 19 marcas, 38 productos y 175 specs.

**d) Cómo llega el dato de la base de datos hasta el JS, sin tocar `script.js` ni `producto.js`**

Como `products.js` se carga en *todas* las páginas del sitio (está enchufado en `app.js`, que se carga desde la plantilla principal `layouts/app.blade.php`), no tenía sentido que un solo controlador (por ejemplo el de "Productos") sea el único que le pase los datos. En vez de eso, se usó lo que Laravel llama un "View Composer": una función que se registra en `AppServiceProvider` y que, cada vez que se va a mostrar la plantilla principal, automáticamente le pide al modelo `Product` todos los productos activos (con su categoría, marca y specs ya incluidas) y los deja listos en una variable (`$productsJson`) con la misma forma exacta que tenía cada producto en `products.js` (`id`, `category`, `brand`, `name`, `image`, `price`, `oldPrice`, `badge`, `featured`, `shortDesc`, `description`, `specs`).

Esa variable se imprime en `layouts/app.blade.php` como `window.PRODUCTS = @json($productsJson)`, en una línea de `<script>` justo antes de que se cargue `app.js`. Como `window.PRODUCTS` ya existe en la página antes de que el navegador ejecute los módulos de JavaScript, `products.js` pudo simplificarse a esto: en vez del array escrito a mano, ahora hace `const PRODUCTS = window.PRODUCTS || []` y exporta `PRODUCTS` y `formatCOP` exactamente igual que antes. `script.js` y `producto.js` siguen haciendo `import { PRODUCTS, formatCOP } from './products.js'` sin ningún cambio: para ellos es invisible que el dato ahora viene de MySQL y no de un array fijo.

**e) Cómo se probó**

Se levantó el sitio con `php artisan serve` y se pidió la página `/productos` con `curl`, confirmando que el HTML trae el `window.PRODUCTS` relleno con los 38 productos en el formato correcto (se revisó el primer producto completo). También se contaron las filas de cada tabla directo en MySQL para confirmar que coinciden con el catálogo original: 8 categorías, 19 marcas, 38 productos, 175 specs.

**Resultado:** ahora, para agregar o modificar un producto, se hace en la base de datos (por ejemplo desde phpMyAdmin, o agregando filas con Eloquent) y el cambio aparece en el sitio automáticamente en todas las páginas, sin tocar ningún archivo de JavaScript.

---

## ⚠️ Aclaración importante: acá NO hay ningún `fetch()`

Esto puede confundir porque uno espera que "traer datos de la base de datos" signifique una llamada AJAX desde el navegador (`fetch('/api/productos')` o algo así). **Acá no existe eso.** La data nunca viaja por una petición separada; se imprime directo dentro del HTML que Laravel genera, antes de que el navegador siquiera empiece a ejecutar JavaScript. El recorrido exacto es:

1. **`app/Providers/AppServiceProvider.php`** — ahí vive un `View::composer('layouts.app', ...)`. Esto es una función que Laravel ejecuta automáticamente cada vez que se va a renderizar la plantilla `layouts.app` (o sea, en cada página del sitio). Adentro hace `Product::with(['category', 'brand', 'specs'])->get()`, que sí es una consulta a la base de datos (pero corre en el servidor, en PHP, no en el navegador), y arma un array con la misma forma que tenían los productos en el viejo `products.js`.

2. **`resources/views/layouts/app.blade.php`, línea 14** — la plantilla principal (el molde de todas las páginas) imprime ese array así: `<script>window.PRODUCTS = @json($productsJson);</script>`. Esa línea la escribe Blade (el motor de plantillas de Laravel) *antes* de la línea `@vite(...)` que carga `app.js`. Cuando el navegador recibe el HTML, ese `<script>` ya viene con los 38 productos escritos adentro, en texto plano JSON.

3. **`resources/js/products.js`, línea 4** — acá es donde el JavaScript "recibe" el dato, pero no lo pide: solo lee una variable global que el HTML ya le dejó puesta. `const PRODUCTS = window.PRODUCTS || [];`

**En criollo:** en vez de que el navegador diga "che, mandame los productos" (fetch/AJAX) y el servidor le conteste después, el servidor ya viene con los productos metidos adentro del sobre (el HTML) cuando lo manda. `script.js` y `producto.js` ni se enteran del cambio, porque para ellos `PRODUCTS` sigue siendo un array normal disponible apenas arranca el script, exactamente como cuando estaba hardcodeado.

---

## En resumen

Antes: los scripts no se ejecutaban, las fotos no cargaban, la mitad de los links te mandaban a un error 404, y la página de cada producto individual ni existía.

Ahora: todo eso está conectado y probado (se corrió el build del proyecto y compila sin errores).
