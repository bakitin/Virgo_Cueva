@props(['valor'])

{{-- Precio en pesos colombianos con el formato de la tienda: $1.234.900 --}}
<span {{ $attributes }}>${{ number_format($valor, 0, ',', '.') }}</span>
