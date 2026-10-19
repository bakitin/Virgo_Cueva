<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('titulo', 'Inicio') | Virgo Cueva</title>

    <link rel="icon" href="{{ asset('images/logo/logo-header.png') }}" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;700&display=swap">

    @vite('resources/css/app.css')
</head>

<body>

    <div class="topbar">
        <div class="container topbar__inner">
            <p>Envíos a toda Colombia · Retiro gratis en tienda (Cali)</p>
            <div class="topbar__account">
                @auth
                    <span class="topbar__user">Hola, {{ auth()->user()->name }}</span><span>·</span>
                    <form method="POST" action="{{ route('logout') }}" class="topbar__logout">
                        @csrf
                        <button type="submit">Cerrar sesión</button>
                    </form>
                @else
                    <a href="{{ route('login') }}">Iniciar sesión</a><span>·</span><a href="{{ route('registro') }}">Crear cuenta</a>
                @endauth
            </div>
        </div>
    </div>

    <header class="header">
        <div class="container header__inner">
            <a href="{{ route('inicio') }}" class="logo">
                <img src="{{ asset('images/logo/logo-header.png') }}" alt="Logo La Virgo Cueva" class="logo__img">
            </a>

            {{-- El menú móvil se abre y cierra con este checkbox (lo controla el CSS, sin JavaScript) --}}
            <input type="checkbox" id="menu-toggle" class="nav-toggle" autocomplete="off">

            <nav class="nav">
                <ul class="nav__list">
                    <li><a href="{{ route('inicio') }}" class="nav__link">Inicio</a></li>
                    <li><a href="{{ route('productos.index') }}" class="nav__link">Productos</a></li>
                    <li><a href="{{ route('ofertas') }}" class="nav__link">Ofertas</a></li>
                    <li><a href="{{ route('nosotros') }}" class="nav__link">Nosotros</a></li>
                    <li>
                        <details class="nav__dropdown">
                            <summary>Ayuda</summary>
                            <ul class="nav__dropdown-menu">
                                <li><a href="{{ route('garantia') }}">Garantía</a></li>
                                <li><a href="{{ route('cambios_devoluciones') }}">Cambios y devoluciones</a></li>
                                <li><a href="{{ route('pago_seguro') }}">Pago seguro</a></li>
                                <li><a href="{{ route('faq') }}">Preguntas frecuentes</a></li>
                            </ul>
                        </details>
                    </li>
                    <li><a href="{{ route('contacto') }}" class="nav__link">Contacto</a></li>
                </ul>
            </nav>

            <div class="header__actions">
                <details class="header__search">
                    <summary class="icon-btn" aria-label="Buscar">
                        <svg class="icon" viewBox="0 0 24 24"><circle cx="10" cy="10" r="7"/><line x1="21" y1="21" x2="15.5" y2="15.5"/></svg>
                    </summary>
                    <form action="{{ route('productos.index') }}" method="GET" class="header__search-form" role="search">
                        <input type="search" name="buscar" value="{{ request('buscar') }}" placeholder="Buscar productos..." aria-label="Buscar productos">
                        <button type="submit" class="btn btn--small">Buscar</button>
                    </form>
                </details>
                @guest
                    <a href="{{ route('login') }}" class="icon-btn" aria-label="Mi cuenta">
                        <svg class="icon" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-6.5 8-6.5s8 2.5 8 6.5"/></svg>
                    </a>
                @endguest
                <a href="{{ route('carrito.index') }}" class="icon-btn" aria-label="Carrito">
                    <svg class="icon" viewBox="0 0 24 24"><circle cx="9" cy="20" r="1.4"/><circle cx="17" cy="20" r="1.4"/><path d="M2.5 3h2.4l2.1 11a2 2 0 0 0 2 1.6h7.4a2 2 0 0 0 2-1.6L20 7.5H6"/></svg>
                    @if ($cartCount > 0)
                        <span class="cart-count">{{ $cartCount }}</span>
                    @endif
                </a>
                <label for="menu-toggle" class="hamburger" aria-label="Abrir menú">
                    <span></span><span></span><span></span>
                </label>
            </div>
        </div>
    </header>

    @if (session('status'))
        <div class="container">
            <p class="alert">{{ session('status') }}</p>
        </div>
    @endif

    @if (session('error'))
        <div class="container">
            <p class="alert alert--error">{{ session('error') }}</p>
        </div>
    @endif

    <main>
        @yield('contenido')
    </main>

    <footer class="footer">
        <div class="container footer__inner">
            <div class="footer__brand">
                <img src="{{ asset('images/logo/logo-header.png') }}" alt="Logo La Virgo Cueva" class="footer__logo">
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
                    <li><a href="{{ route('productos.index') }}">Productos</a></li>
                    <li><a href="{{ route('ofertas') }}">Ofertas</a></li>
                    <li><a href="{{ route('nosotros') }}">Nosotros</a></li>
                </ul>
            </div>
            <div class="footer__links">
                <h4>Ayuda</h4>
                <ul>
                    <li><a href="{{ route('garantia') }}">Garantía</a></li>
                    <li><a href="{{ route('cambios_devoluciones') }}">Cambios y devoluciones</a></li>
                    <li><a href="{{ route('pago_seguro') }}">Pago seguro</a></li>
                    <li><a href="{{ route('faq') }}">Preguntas frecuentes</a></li>
                    <li><a href="{{ route('contacto') }}">Contacto</a></li>
                </ul>
            </div>
            <div class="footer__links">
                <h4>Mi cuenta</h4>
                <ul>
                    @guest
                        <li><a href="{{ route('login') }}">Iniciar sesión</a></li>
                        <li><a href="{{ route('registro') }}">Crear cuenta</a></li>
                    @endguest
                    <li><a href="{{ route('carrito.index') }}">Mi carrito</a></li>
                </ul>
            </div>
        </div>
        <p class="footer__copy">© 2026 La Virgo Cueva. Hecho con cariño (y varios cafés) para la comunidad gamer.</p>
    </footer>

</body>
</html>
