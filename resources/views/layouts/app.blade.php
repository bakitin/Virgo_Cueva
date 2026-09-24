<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="{{ asset('images/logo/logo-header.png')  }}" type="image/x-icon">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>@yield('titulo') | Virgo Cueva</title>


    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <div class="topbar">
        <div class="container topbar__inner">
        <p>Envíos a toda Colombia · Retiro gratis en tienda (Cali)</p>
        <div class="topbar__account">
            <a href="/login">Iniciar sesión</a><span>·</span><a href="/nuevou">Crear cuenta</a>
        </div>
        </div>
  </div>

  <header class="header">
    <div class="container header__inner">
      <a href="/" class="logo">
        <img src=" {{ asset('images/logo/logo-header.png')  }}" alt="Logo La Virgo Cueva" class="logo__img">
      </a>
      <nav class="nav" id="nav">
        <ul class="nav__list">
          <li><a href="/" class="nav__link">Inicio</a></li>
          <li><a href="/productos" class="nav__link">Productos</a></li>
          <li><a href="/ofertas" class="nav__link">Ofertas</a></li>
          <li><a href="/nosotros" class="nav__link">Nosotros</a></li>
          <li>
            <details class="nav__dropdown">
              <summary>Ayuda</summary>
              <ul class="nav__dropdown-menu">
                <li><a href="/garantia">Garantía</a></li>
                <li><a href="/cambios_devoluciones">Cambios y devoluciones</a></li>
                <li><a href="/pago_seguro">Pago seguro</a></li>
                <li><a href="/faq">Preguntas frecuentes</a></li>
              </ul>
            </details>
          </li>
          <li><a href="/contacto" class="nav__link">Contacto</a></li>
        </ul>
      </nav>
      <div class="header__actions">
        <button class="icon-btn" aria-label="Buscar">
          <svg class="icon" viewBox="0 0 24 24"><circle cx="10" cy="10" r="7"/><line x1="21" y1="21" x2="15.5" y2="15.5"/></svg>
        </button>
        <a href="/login" class="icon-btn" aria-label="Mi cuenta">
          <svg class="icon" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-6.5 8-6.5s8 2.5 8 6.5"/></svg>
        </a>
        <a href="/carrito" class="icon-btn" aria-label="Carrito">
          <svg class="icon" viewBox="0 0 24 24"><circle cx="9" cy="20" r="1.4"/><circle cx="17" cy="20" r="1.4"/><path d="M2.5 3h2.4l2.1 11a2 2 0 0 0 2 1.6h7.4a2 2 0 0 0 2-1.6L20 7.5H6"/></svg>
          <span class="cart-count">2</span>
        </a>
        <button class="hamburger" id="hamburger" aria-label="Abrir menú">
          <span></span><span></span><span></span>
        </button>
      </div>
    </div>
  </header>

    @yield('contenido')
    
    
    

  <footer class="footer">
    <div class="container footer__inner">
      <div class="footer__brand">
        <img src="{{ asset('images/logo/logo-header.png')  }}" alt="Logo La Virgo Cueva" class="footer__logo">
        <p>Periféricos gamer elegidos y probados por nosotros. Sin relleno, sin letra chica.</p>
        <div class="contact__social">
          <a href="#" aria-label="Instagram">IG</a>
          <a href="#" aria-label="TikTok">TT</a>
          <a href="#" aria-label="WhatsApp">WA</a>
        </div>
      </div>
      <div class="footer__links">
        <h4>Tienda</h4>
        <ul>
          <li><a href="/productos">Productos</a></li>
          <li><a href="/ofertas">Ofertas</a></li>
          <li><a href="/nosotros">Nosotros</a></li>
        </ul>
      </div>
      <div class="footer__links">
        <h4>Ayuda</h4>
        <ul>
          <li><a href="/garantia">Garantía</a></li>
          <li><a href="/cambios_devoluciones">Cambios y devoluciones</a></li>
          <li><a href="/pago_seguro">Pago seguro</a></li>
          <li><a href="/faq">Preguntas frecuentes</a></li>
          <li><a href="/contacto">Contacto</a></li>
        </ul>
      </div>
      <div class="footer__links">
        <h4>Mi cuenta</h4>
        <ul>
          <li><a href="/login">Iniciar sesión</a></li>
          <li><a href="/nuevou">Crear cuenta</a></li>
          <li><a href="/carrito">Mi carrito</a></li>
        </ul>
      </div>
    </div>
    <p class="footer__copy">© 2026 La Virgo Cueva. Hecho con cariño (y varios cafés) para la comunidad gamer.</p>
  </footer>
</body>
</html>


