@extends('layouts.app')

@section('titulo', 'Carrito')

@section('contenido')

    <section class="page-header">
        <div class="container">
            <span class="eyebrow">Tu carrito</span>
            <h1>Revisa antes de pagar</h1>
            <p>Ajusta las cantidades o quita lo que ya no quieras llevar.</p>
        </div>
    </section>

    <section class="cart">
        <div class="container">

            @error('cantidad')
                <p class="alert alert--error">{{ $message }}</p>
            @enderror

            @if ($items->isEmpty())
                <div class="cart-empty">
                    <svg class="icon" viewBox="0 0 24 24"><circle cx="9" cy="20" r="1.4"/><circle cx="17" cy="20" r="1.4"/><path d="M2.5 3h2.4l2.1 11a2 2 0 0 0 2 1.6h7.4a2 2 0 0 0 2-1.6L20 7.5H6"/></svg>
                    <h3>Tu carrito está vacío</h3>
                    <p style="color:var(--text-muted); margin:10px 0 24px">Todavía no has agregado productos.</p>
                    <a href="{{ route('productos.index') }}" class="btn btn--primary">Ver productos</a>
                </div>
            @else
                <div class="cart__inner">
                    <div class="cart-items">
                        @foreach ($items as $item)
                            <div class="cart-item">
                                <img src="{{ asset($item['product']->image) }}" alt="{{ $item['product']->name }}">
                                <div>
                                    <h3><a href="{{ route('productos.show', $item['product']) }}">{{ $item['product']->name }}</a></h3>
                                    <p>{{ $item['product']->brand->name }} · <x-precio :valor="$item['product']->price" /> c/u</p>

                                    <form method="POST" action="{{ route('carrito.update', $item['product']) }}" class="cart-item__qty">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" name="cantidad" value="{{ $item['quantity'] - 1 }}" aria-label="Restar" @disabled($item['quantity'] <= 1)>−</button>
                                        <span class="cart-item__qty-value">{{ $item['quantity'] }}</span>
                                        <button type="submit" name="cantidad" value="{{ $item['quantity'] + 1 }}" aria-label="Sumar" @disabled($item['quantity'] >= $item['product']->stock)>+</button>
                                    </form>

                                    <form method="POST" action="{{ route('carrito.destroy', $item['product']) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="cart-item__remove">Eliminar</button>
                                    </form>
                                </div>
                                <x-precio :valor="$item['subtotal']" class="cart-item__price" />
                            </div>
                        @endforeach
                    </div>

                    <aside class="cart-summary">
                        <h3>Resumen</h3>
                        <div class="cart-summary__row"><span>Subtotal</span><x-precio :valor="$subtotal" /></div>
                        <div class="cart-summary__row"><span>Envío</span><x-precio :valor="$shipping" /></div>
                        <div class="cart-summary__row cart-summary__row--total"><span>Total</span><x-precio :valor="$total" /></div>
                        <button type="button" class="btn btn--primary btn--block" style="margin-top:20px" disabled>Ir a pagar</button>
                        <p class="cart-summary__note">El pago en línea todavía no está disponible.</p>
                        <p style="text-align:center; margin-top:14px">
                            <a href="{{ route('productos.index') }}" style="color:var(--text-muted); font-size:.85rem;">Seguir comprando</a>
                        </p>
                    </aside>
                </div>
            @endif

        </div>
    </section>

@endsection
