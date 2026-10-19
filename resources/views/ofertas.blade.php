@extends('layouts.app')

@section('titulo', 'Ofertas')

@section('contenido')

    <section class="page-header">
        <div class="container">
            <span class="eyebrow">Por tiempo limitado</span>
            <h1>Ofertas de la semana</h1>
            <p>Precios rebajados en productos seleccionados. Stock limitado, sin letra chica.</p>

            <div class="countdown" style="justify-content:center" aria-label="Tiempo que queda de las ofertas">
                <div class="countdown__box"><strong>{{ sprintf('%02d', $countdown['days']) }}</strong><span>Días</span></div>
                <div class="countdown__box"><strong>{{ sprintf('%02d', $countdown['hours']) }}</strong><span>Horas</span></div>
                <div class="countdown__box"><strong>{{ sprintf('%02d', $countdown['minutes']) }}</strong><span>Min</span></div>
            </div>
        </div>
    </section>

    <section class="products" style="padding-top:32px">
        <div class="container">
            <div class="products__grid">
                @forelse ($products as $product)
                    <x-product-card :product="$product" />
                @empty
                    <p class="products__empty">Esta semana no hay ofertas activas, pero vienen más 😉</p>
                @endforelse
            </div>
        </div>
    </section>

@endsection
