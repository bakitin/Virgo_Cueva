@props(['product'])

<article {{ $attributes->merge(['class' => 'product-card']) }}>
    @if ($product->old_price)
        <span class="product-card__badge product-card__badge--sale">Oferta</span>
    @elseif ($product->badge)
        <span class="product-card__badge">{{ $product->badge }}</span>
    @endif

    <a href="{{ route('productos.show', $product) }}">
        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" loading="lazy">
        <span class="product-card__brand">{{ $product->brand->name }}</span>
        <h3 class="product-card__name">{{ $product->name }}</h3>
    </a>

    <p class="product-card__desc">{{ $product->short_description }}</p>

    <div class="product-card__footer">
        <span>
            @if ($product->old_price)
                <x-precio :valor="$product->old_price" class="product-card__price-old" />
            @endif
            <x-precio :valor="$product->price" class="product-card__price" />
        </span>
        <a href="{{ route('productos.show', $product) }}" class="btn btn--small">Ver producto</a>
    </div>
</article>
