@extends('layouts.app')

@section('titulo', 'Inicio')

@section('contenido')

    <section class="hero">
        <div class="hero__media">
            <div class="hero__overlay"></div>
        </div>

        <div class="container hero__content">
            <span class="eyebrow">Desde 2019 · Hecho en Cali, Colombia</span>
            <h1 class="hero__title">Arma el setup que siempre quisiste, <span>sin vueltas</span></h1>
            <p class="hero__subtitle">Elegimos cada producto probándolo nosotros mismos antes de venderlo. Si no lo usaríamos, no está en la tienda.</p>
            <div class="hero__buttons">
                <a href="{{ route('productos.index') }}" class="btn btn--primary">Ver productos</a>
                <a href="{{ route('ofertas') }}" class="btn btn--outline">Ver ofertas</a>
            </div>
            <p style="margin-top:28px"><span class="sticker">Hecho por gamers, para gamers ✌</span></p>
        </div>
    </section>

    <section class="categories">
        <div class="container">
            <h2 class="section-title">¿Qué andas buscando?</h2>
            <div class="categories__grid">
                @foreach ($categories as $category)
                    <a href="{{ route('productos.index', ['categoria' => $category->slug]) }}" class="category-card">
                        <img src="{{ asset($category->image) }}" alt="{{ $category->name }}">
                        <span>{{ $category->name }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="benefits">
        <div class="container benefits__grid">
            <a href="{{ route('contacto') }}" class="benefit">
                <svg class="icon" viewBox="0 0 24 24"><rect x="1" y="7" width="13" height="9" rx="1"/><path d="M14 10h4l3.5 3.5V16h-7.5z"/><circle cx="6" cy="18.5" r="1.6"/><circle cx="17.5" cy="18.5" r="1.6"/></svg>
                <div><strong>Envío a toda Colombia</strong><small>2 a 5 días hábiles</small></div>
            </a>
            <a href="{{ route('garantia') }}" class="benefit">
                <svg class="icon" viewBox="0 0 24 24"><path d="M12 3l7 3v5c0 5-3.4 8.6-7 10-3.6-1.4-7-5-7-10V6z"/><path d="M9 12l2 2 4-4.5"/></svg>
                <div><strong>Garantía real</strong><small>Hasta 24 meses</small></div>
            </a>
            <a href="{{ route('pago_seguro') }}" class="benefit">
                <svg class="icon" viewBox="0 0 24 24"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
                <div><strong>Pago seguro</strong><small>Varios medios de pago</small></div>
            </a>
            <a href="{{ route('cambios_devoluciones') }}" class="benefit">
                <svg class="icon" viewBox="0 0 24 24"><path d="M4 4v6h6"/><path d="M20 20v-6h-6"/><path d="M5.5 15A8 8 0 0 0 19 17.5"/><path d="M18.5 9A8 8 0 0 0 5 6.5"/></svg>
                <div><strong>Cambios fáciles</strong><small>10 días para decidir</small></div>
            </a>
        </div>
    </section>

    <section class="products">
        <div class="container">
            <h2 class="section-title">Lo más pedido</h2>
            <p class="section-subtitle">Los que se venden solos.</p>

            <div class="products__grid">
                @foreach ($featuredProducts as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>

            <p style="text-align:center; margin-top:40px">
                <a href="{{ route('productos.index') }}" class="btn btn--ghost">Ver catálogo completo</a>
            </p>
        </div>
    </section>

    <section class="offer-banner">
        <div class="container offer-banner__inner">
            <div class="offer-banner__text">
                <h2>Hasta 30% de descuento</h2>
                <p>En audífonos y mouses seleccionados, por tiempo limitado. Ojo que se acaban rápido.</p>
                <a href="{{ route('ofertas') }}" class="btn btn--primary" style="background:#1c1208; color:#fff;">Ver todas las ofertas</a>
            </div>

            <div class="offer-banner__media">
                <img src="{{ asset('images/gpu/GPU_EN_PROMO-Recovered.png') }}" alt="Productos en oferta">
            </div>
        </div>
    </section>

@endsection
