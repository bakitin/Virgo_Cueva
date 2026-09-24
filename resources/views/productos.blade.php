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
      <div class="filters" id="filters">
        <button class="filter-btn is-active" data-filter="todos">Todos</button>
        <button class="filter-btn" data-filter="teclados">Teclados</button>
        <button class="filter-btn" data-filter="mouses">Mouses</button>
        <button class="filter-btn" data-filter="audio">Audio</button>
        <button class="filter-btn" data-filter="monitores">Monitores</button>
        <button class="filter-btn" data-filter="sillas">Sillas</button>
        <button class="filter-btn" data-filter="gabinetes">Gabinetes</button>
        <button class="filter-btn" data-filter="gpu">Tarjetas de video</button>
        <button class="filter-btn" data-filter="procesadores">Procesadores</button>
      </div>

      <div class="products__grid" id="productsGrid" data-mode="all">


      </div>
    </div>
  </section>
    
@endsection