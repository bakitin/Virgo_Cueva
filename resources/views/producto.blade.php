@extends('layouts.app')

@section('titulo', $product->name)

@section('contenido')

    <section class="product-detail">
        <div class="container">

            <p class="breadcrumb">
                <a href="{{ route('productos.index') }}">Productos</a> ·
                <a href="{{ route('productos.index', ['categoria' => $product->category->slug]) }}">{{ $product->category->name }}</a> ·
                <span>{{ $product->name }}</span>
            </p>

            <div class="product-detail__inner">
                <div class="product-detail__media">
                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                </div>

                <div>
                    @if ($product->old_price)
                        <span class="detail-badge">Oferta</span>
                    @elseif ($product->badge)
                        <span class="detail-badge">{{ $product->badge }}</span>
                    @endif
                    <span class="product-detail__brand">{{ $product->brand->name }}</span>
                    <h1 class="product-detail__name">{{ $product->name }}</h1>

                    <div class="product-detail__price-row">
                        <x-precio :valor="$product->price" class="product-detail__price" />
                        @if ($product->old_price)
                            <x-precio :valor="$product->old_price" class="product-detail__price-old" />
                        @endif
                    </div>

                    <p class="product-detail__desc">{{ $product->description }}</p>

                    @if ($product->specs->isNotEmpty())
                        <ul class="product-detail__specs">
                            @foreach ($product->specs as $spec)
                                <li>{{ $spec->value }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="product-detail__actions">
                        <form method="POST" action="{{ route('carrito.store', $product) }}">
                            @csrf
                            <button type="submit" class="btn btn--primary">Agregar al carrito</button>
                        </form>
                        <a href="{{ route('productos.index') }}" class="btn btn--outline">Seguir viendo productos</a>
                    </div>
                </div>
            </div>

            @if ($relatedProducts->isNotEmpty())
                <section class="products" style="padding-top:56px">
                    <h2 class="section-title">También te puede interesar</h2>
                    <div class="products__grid">
                        @foreach ($relatedProducts as $relatedProduct)
                            <x-product-card :product="$relatedProduct" />
                        @endforeach
                    </div>
                </section>
            @endif

        </div>
    </section>

@endsection
