  @extends('layouts.app')

  @section( 'contenido')
  
  <section class="page-header">
    <div class="container">
      <span class="eyebrow">Por tiempo limitado</span>
      <h1>Ofertas de la semana</h1>
      <p>Precios rebajados en productos seleccionados. Stock limitado, sin letra chica.</p>

      <div class="countdown" id="countdown" style="justify-content:center">
        <div class="countdown__box"><strong id="cd-dias">00</strong><span>Días</span></div>
        <div class="countdown__box"><strong id="cd-horas">00</strong><span>Horas</span></div>
        <div class="countdown__box"><strong id="cd-min">00</strong><span>Min</span></div>
        <div class="countdown__box"><strong id="cd-seg">00</strong><span>Seg</span></div>
      </div>
    </div>
  </section>
  
  @endsection