@extends('layouts.app')

@section('titulo', 'Administrar productos')

@section('contenido')

    <section class="page-header">
        <div class="container">
            <span class="eyebrow">Panel de administración</span>
            <h1>Productos</h1>
            <p>{{ $products->count() }} productos en el catálogo. Los ocultos no aparecen en la tienda.</p>
        </div>
    </section>

    <section class="admin">
        <div class="container">
            <div class="admin__toolbar">
                <a href="{{ route('admin.productos.create') }}" class="btn btn--primary">+ Nuevo producto</a>
            </div>

            <div class="admin-table-wrap">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Categoría</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td>
                                    <div class="admin-table__product">
                                        <img src="{{ asset($product->image) }}" alt="">
                                        <div>
                                            @if ($product->is_active)
                                                <a href="{{ route('productos.show', $product) }}">{{ $product->name }}</a>
                                            @else
                                                <strong>{{ $product->name }}</strong>
                                            @endif
                                            <small>{{ $product->brand->name }} · {{ $product->slug }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $product->category->name }}</td>
                                <td class="admin-table__price">
                                    <x-precio :valor="$product->price" />
                                    @if ($product->old_price)
                                        <x-precio :valor="$product->old_price" class="product-card__price-old" />
                                    @endif
                                </td>
                                <td>{{ $product->stock }}</td>
                                <td>
                                    @if ($product->is_active)
                                        <span class="tag tag--on">Visible</span>
                                    @else
                                        <span class="tag tag--off">Oculto</span>
                                    @endif
                                    @if ($product->featured)
                                        <span class="tag tag--featured">Destacado</span>
                                    @endif
                                </td>
                                <td class="admin-table__actions">
                                    <a href="{{ route('admin.productos.edit', $product) }}" class="btn btn--small">Editar</a>
                                    {{-- Confirmación sin JavaScript: el botón final solo aparece al abrir el <details> --}}
                                    <details class="admin-delete">
                                        <summary class="btn btn--small btn--danger">Eliminar</summary>
                                        <form method="POST" action="{{ route('admin.productos.destroy', $product) }}" class="admin-delete__confirm">
                                            @csrf
                                            @method('DELETE')
                                            <p>¿Eliminar «{{ $product->name }}»? No se puede deshacer.</p>
                                            <button type="submit" class="btn btn--small btn--danger">Sí, eliminar</button>
                                        </form>
                                    </details>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="admin-table__empty">Todavía no hay productos.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>

@endsection
