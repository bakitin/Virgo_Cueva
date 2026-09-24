import { PRODUCTS, formatCOP } from './products.js';
import { productCardHTML } from './script.js';

// Página de detalle de producto: lee ?id= de la URL y llena la plantilla con datos de PRODUCTS
const contentEl = document.getElementById('product-content');
const notFoundEl = document.getElementById('product-not-found');

if (contentEl) {
const params = new URLSearchParams(window.location.search);
const producto = PRODUCTS.find(p => p.id === params.get('id'));

const categoryLabels = {
  teclados: 'Teclados',
  mouses: 'Mouses',
  audio: 'Audio',
  monitores: 'Monitores',
  sillas: 'Sillas',
  gabinetes: 'Gabinetes',
  gpu: 'Tarjetas de video',
  procesadores: 'Procesadores'
};

if (!producto) {
  contentEl.style.display = 'none';
  notFoundEl.style.display = 'block';
} else {
  document.title = `${producto.name} | La Virgo Cueva`;

  document.getElementById('prod-image').src = producto.image;
  document.getElementById('prod-image').alt = producto.name;
  document.getElementById('prod-breadcrumb-category').textContent = categoryLabels[producto.category] || producto.category;
  document.getElementById('prod-breadcrumb-category').href = `/productos#${producto.category}`;
  document.getElementById('prod-breadcrumb-name').textContent = producto.name;
  document.getElementById('prod-brand').textContent = producto.brand;
  document.getElementById('prod-name').textContent = producto.name;
  document.getElementById('prod-desc').textContent = producto.description;

  const priceEl = document.getElementById('prod-price');
  const oldPriceEl = document.getElementById('prod-oldprice');
  priceEl.textContent = formatCOP(producto.price);
  if (producto.oldPrice) {
    oldPriceEl.textContent = formatCOP(producto.oldPrice);
    oldPriceEl.style.display = '';
  }

  const badgeEl = document.getElementById('prod-badge');
  if (producto.oldPrice) {
    badgeEl.textContent = 'Oferta';
    badgeEl.style.display = '';
  } else if (producto.badge) {
    badgeEl.textContent = producto.badge;
    badgeEl.style.display = '';
  }

  const specsEl = document.getElementById('prod-specs');
  specsEl.innerHTML = producto.specs.map(s => `<li>${s}</li>`).join('');

  // Otros productos de la misma categoría
  const relacionados = PRODUCTS.filter(p => p.category === producto.category && p.id !== producto.id).slice(0, 4);
  const relatedGrid = document.getElementById('related-grid');
  const relatedSection = document.getElementById('related-section');
  if (relacionados.length) {
    relatedGrid.innerHTML = relacionados.map(productCardHTML).join('');
  } else {
    relatedSection.style.display = 'none';
  }
}
}
