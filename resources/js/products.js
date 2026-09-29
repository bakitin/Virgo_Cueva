// Catálogo de productos de La Virgo Cueva
// Los datos ya no viven acá: vienen de la base de datos, inyectados por el
// controlador/vista Laravel como window.PRODUCTS (ver layouts/app.blade.php).
const PRODUCTS = window.PRODUCTS || [];

function formatCOP(amount) {
  return '$' + Number(amount).toLocaleString('es-CO');
}

export { PRODUCTS, formatCOP };
