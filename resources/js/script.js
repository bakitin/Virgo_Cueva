import { PRODUCTS, formatCOP } from './products.js';

// Menú móvil
const hamburger = document.getElementById('hamburger');
const nav = document.getElementById('nav');

if (hamburger && nav) {
  hamburger.addEventListener('click', () => nav.classList.toggle('is-open'));
  nav.querySelectorAll('.nav__link, .nav__dropdown-menu a').forEach(link => {
    link.addEventListener('click', () => nav.classList.remove('is-open'));
  });
}

// Render de grillas de productos a partir de PRODUCTS (js/products.js)
const productsGrid = document.getElementById('productsGrid');

export function productCardHTML(p) {
  const badge = p.oldPrice ? '<span class="product-card__badge product-card__badge--sale">Oferta</span>'
    : p.badge ? `<span class="product-card__badge">${p.badge}</span>` : '';
  const oldPrice = p.oldPrice ? `<span class="product-card__price-old">${formatCOP(p.oldPrice)}</span>` : '';
  return `
    <article class="product-card" data-category="${p.category}">
      ${badge}
      <a href="/producto?id=${p.id}">
        <img src="${p.image}" alt="${p.name}" loading="lazy">
        <span class="product-card__brand">${p.brand}</span>
        <h3 class="product-card__name">${p.name}</h3>
      </a>
      <p class="product-card__desc">${p.shortDesc}</p>
      <div class="product-card__footer">
        <span>${oldPrice}<span class="product-card__price">${formatCOP(p.price)}</span></span>
        <a href="/producto?id=${p.id}" class="btn btn--small">Ver producto</a>
      </div>
    </article>`;
}

function renderProducts(list) {
  productsGrid.innerHTML = list.length
    ? list.map(productCardHTML).join('')
    : '<p class="products__empty">No hay productos en esta categoría todavía.</p>';
}

if (productsGrid) {
  const modo = productsGrid.dataset.mode || 'all';
  let base = PRODUCTS;
  if (modo === 'destacados') base = PRODUCTS.filter(p => p.featured);
  if (modo === 'ofertas') base = PRODUCTS.filter(p => p.oldPrice);

  renderProducts(base);

  const filterButtons = document.querySelectorAll('.filter-btn');
  if (filterButtons.length) {
    filterButtons.forEach(btn => {
      btn.addEventListener('click', () => {
        filterButtons.forEach(b => b.classList.toggle('is-active', b === btn));
        const filter = btn.dataset.filter;
        renderProducts(filter === 'todos' ? base : base.filter(p => p.category === filter));
      });
    });

    // Si llegamos desde un link de categoría (ej: productos.html#teclados), preseleccionamos el filtro
    if (window.location.hash) {
      const filtroInicial = window.location.hash.replace('#', '');
      const btnInicial = document.querySelector(`.filter-btn[data-filter="${filtroInicial}"]`);
      if (btnInicial) btnInicial.click();
    }
  }
}

// Acordeón de preguntas frecuentes
document.querySelectorAll('.faq-item__question').forEach(question => {
  question.addEventListener('click', () => {
    const item = question.parentElement;
    const isOpen = item.classList.contains('is-open');
    item.parentElement.querySelectorAll('.faq-item').forEach(i => i.classList.remove('is-open'));
    if (!isOpen) item.classList.add('is-open');
  });
});

// Cuenta regresiva (ofertas.html)
const countdown = document.getElementById('countdown');
if (countdown) {
  const meta = new Date('2026-09-30T23:59:59');
  const dEl = document.getElementById('cd-dias');
  const hEl = document.getElementById('cd-horas');
  const mEl = document.getElementById('cd-min');
  const sEl = document.getElementById('cd-seg');

  function actualizarCountdown() {
    const restante = meta - new Date();
    if (restante <= 0) {
      countdown.innerHTML = '<p>La oferta ya terminó, pero vienen más 😉</p>';
      return;
    }
    const dias = Math.floor(restante / 86400000);
    const horas = Math.floor((restante % 86400000) / 3600000);
    const min = Math.floor((restante % 3600000) / 60000);
    const seg = Math.floor((restante % 60000) / 1000);
    dEl.textContent = String(dias).padStart(2, '0');
    hEl.textContent = String(horas).padStart(2, '0');
    mEl.textContent = String(min).padStart(2, '0');
    sEl.textContent = String(seg).padStart(2, '0');
  }
  actualizarCountdown();
  setInterval(actualizarCountdown, 1000);
}

// Formularios de login / registro (sin backend: solo feedback visual)
document.querySelectorAll('.js-demo-form').forEach(form => {
  form.addEventListener('submit', (e) => {
    e.preventDefault();
    const msg = form.querySelector('.form-message');
    if (msg) {
      msg.textContent = form.dataset.successMsg || 'Listo. (Formulario de ejemplo, falta conectar un backend real).';
      msg.classList.add('is-visible');
    }
  });
});

// Carrito de ejemplo (carrito.html): sumar/restar cantidad y recalcular totales
const cartItems = document.querySelectorAll('.cart-item');
if (cartItems.length) {
  const subtotalEl = document.getElementById('cart-subtotal');
  const totalEl = document.getElementById('cart-total');
  const envio = 17900;

  function recalcularCarrito() {
    let subtotal = 0;
    cartItems.forEach(item => {
      if (item.style.display === 'none') return;
      const precio = Number(item.dataset.price);
      const cantidad = Number(item.querySelector('.cart-item__qty-value').textContent);
      subtotal += precio * cantidad;
      item.querySelector('.cart-item__price').textContent = `$${(precio * cantidad).toLocaleString('es-CO')}`;
    });
    subtotalEl.textContent = `$${subtotal.toLocaleString('es-CO')}`;
    totalEl.textContent = `$${(subtotal + envio).toLocaleString('es-CO')}`;
  }

  cartItems.forEach(item => {
    const valueEl = item.querySelector('.cart-item__qty-value');
    item.querySelector('.cart-item__qty-more').addEventListener('click', () => {
      valueEl.textContent = Number(valueEl.textContent) + 1;
      recalcularCarrito();
    });
    item.querySelector('.cart-item__qty-less').addEventListener('click', () => {
      const actual = Number(valueEl.textContent);
      if (actual > 1) valueEl.textContent = actual - 1;
      recalcularCarrito();
    });
    item.querySelector('.cart-item__remove').addEventListener('click', () => {
      item.style.display = 'none';
      recalcularCarrito();
      const visibles = [...cartItems].some(i => i.style.display !== 'none');
      document.getElementById('cart-empty').style.display = visibles ? 'none' : 'block';
      document.getElementById('cart-content').style.display = visibles ? '' : 'none';
    });
  });

  recalcularCarrito();
}
