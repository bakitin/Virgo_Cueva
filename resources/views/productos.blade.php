@extends('layouts.app')

@section('titulo', 'Productos')

@section('contenido')

    <section class="page-header">
        <div class="container">
            <span class="eyebrow">Catálogo completo</span>
            <h1>Todo lo que necesitas para tu setup</h1>
            <p>Filtra por categoría o revisa todo. Cada precio incluye IVA.</p>
        </div>
    </section>

    <section class="products" style="padding-top:32px">
        <div class="container">
            <nav class="filters" aria-label="Filtrar por categoría">
                <a href="{{ request()->fullUrlWithoutQuery('categoria') }}" @class(['filter-btn', 'is-active' => $categorySlug === ''])>Todos</a>
                @foreach ($categories as $category)
                    <a href="{{ request()->fullUrlWithQuery(['categoria' => $category->slug]) }}" @class(['filter-btn', 'is-active' => $categorySlug === $category->slug])>{{ $category->name }}</a>
                @endforeach
            </nav>

            @if ($search !== '')
                <p class="products__search">
                    Resultados para «{{ $search }}» · <a href="{{ request()->fullUrlWithoutQuery('buscar') }}">Quitar búsqueda</a>
                </p>
            @endif

            <div class="products__grid">
                @forelse ($products as $product)
                    <x-product-card :product="$product" />
                @empty
                    <p class="products__empty">No encontramos productos con esos filtros.</p>
                @endforelse
            </div>
        </div>
    </section>

@endsection
