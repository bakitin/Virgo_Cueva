@extends('layouts.app')

@section('titulo', 'Página no encontrada')

@section('contenido')

    <section class="product-detail">
        <div class="container">
            <div class="product-detail__not-found">
                <h2>No encontramos lo que buscas</h2>
                <p style="color:var(--text-muted); margin:10px 0 24px">El producto o la página que buscas no existe o ya no está disponible.</p>
                <a href="{{ route('productos.index') }}" class="btn btn--primary">Ver catálogo</a>
            </div>
        </div>
    </section>

@endsection
