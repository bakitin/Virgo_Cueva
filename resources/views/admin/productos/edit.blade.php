@extends('layouts.app')

@section('titulo', 'Editar '.$product->name)

@section('contenido')

    <section class="page-header">
        <div class="container">
            <span class="eyebrow">Panel de administración</span>
            <h1>Editar producto</h1>
            <p><a href="{{ route('admin.productos.index') }}" style="color:var(--primary)">← Volver a la lista</a></p>
        </div>
    </section>

    <section class="admin">
        <div class="container">
            <form method="POST" action="{{ route('admin.productos.update', $product) }}" enctype="multipart/form-data" class="admin-form">
                @method('PUT')
                @include('admin.productos.form', ['product' => $product, 'categories' => $categories, 'brands' => $brands])
            </form>
        </div>
    </section>

@endsection
