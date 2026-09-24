@extends('layouts.app')

@section('titulo', 'Producto')

@section('contenido')

<section class="product-detail">
  <div class="container">

    <div id="product-not-found" class="product-detail__not-found" style="display:none">
      <h2>Producto no encontrado</h2>
      <p style="color:var(--text-muted); margin:10px 0 24px">El producto que buscas no existe o ya no está disponible.</p>
      <a href="/productos" class="btn btn--primary">Ver catálogo</a>
    </div>

    <div id="product-content">
      <p class="breadcrumb">
        <a href="/productos">Productos</a> ·
        <a id="prod-breadcrumb-category" href="/productos"></a> ·
        <span id="prod-breadcrumb-name"></span>
      </p>

      <div class="product-detail__inner">
        <div class="product-detail__media">
          <img id="prod-image" src="" alt="">
        </div>

        <div>
          <span id="prod-badge" class="detail-badge" style="display:none"></span>
          <span id="prod-brand" class="product-detail__brand"></span>
          <h1 id="prod-name" class="product-detail__name"></h1>

          <div class="product-detail__price-row">
            <span id="prod-price" class="product-detail__price"></span>
            <span id="prod-oldprice" class="product-detail__price-old" style="display:none"></span>
          </div>

          <p id="prod-desc" class="product-detail__desc"></p>

          <ul id="prod-specs" class="product-detail__specs"></ul>

          <div class="product-detail__actions">
            <button type="button" class="btn btn--primary">Agregar al carrito</button>
            <a href="/productos" class="btn btn--outline">Seguir viendo productos</a>
          </div>
        </div>
      </div>
    </div>

    <section id="related-section" class="products" style="padding-top:56px">
      <h2 class="section-title">También te puede interesar</h2>
      <div class="products__grid" id="related-grid"></div>
    </section>

  </div>
</section>

@endsection
