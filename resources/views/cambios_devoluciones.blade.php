 @extends('layouts.app')

@section('contenido')
 
 <section class="page-header">
    <div class="container">
      <span class="eyebrow">Sin drama</span>
      <h1>Cambios y devoluciones</h1>
      <p>Si algo no te calzó, este es el proceso. Sin vueltas ni preguntas incómodas.</p>
    </div>
  </section>

  <section class="policy" style="padding-top:32px">
    <div class="container">
      <h2 class="section-title">El proceso en 4 pasos</h2>
      <div class="steps">
        <div class="step">
          <div class="step__num"></div>
          <div><h3>Avísanos dentro de 10 días corridos</h3><p>Contados desde que recibiste el pedido. Basta un mensaje por WhatsApp o correo.</p></div>
        </div>
        <div class="step">
          <div class="step__num"></div>
          <div><h3>Nos cuentas el motivo</h3><p>No te vamos a interrogar: cambio de talla, no cumplió tus expectativas o simplemente te arrepentiste, todo aplica.</p></div>
        </div>
        <div class="step">
          <div class="step__num"></div>
          <div><h3>Coordinamos el retiro</h3><p>Pasamos a buscar el producto o te damos una guía de envío prepagada, según tu comuna.</p></div>
        </div>
        <div class="step">
          <div class="step__num"></div>
          <div><h3>Cambio o reembolso</h3><p>Una vez que revisamos el producto, procesamos el cambio o el reembolso en un máximo de 5 días hábiles.</p></div>
        </div>
      </div>
    </div>
  </section>

  <section class="policy">
    <div class="container">
      <h2 class="section-title">Qué aplica y qué no</h2>
      <ul class="condition-list">
        <li><svg class="icon" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M8 12l2.5 2.5L16 9"/></svg> Producto en su empaque original, sin señales de mal uso.</li>
        <li><svg class="icon" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M8 12l2.5 2.5L16 9"/></svg> Accesorios, cables y manuales incluidos.</li>
        <li><svg class="icon" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M8 12l2.5 2.5L16 9"/></svg> Factura o número de pedido a mano.</li>
        <li class="no"><svg class="icon" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M9 9l6 6M15 9l-6 6"/></svg> Productos con daño evidente por mal uso (golpes, líquidos).</li>
        <li class="no"><svg class="icon" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M9 9l6 6M15 9l-6 6"/></svg> Solicitudes fuera del plazo de 10 días corridos.</li>
        <li class="no"><svg class="icon" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M9 9l6 6M15 9l-6 6"/></svg> Productos personalizados o marcados como "sin devolución" en su ficha.</li>
      </ul>
      <p style="text-align:center; margin-top:36px">
        <a href="/contacto" class="btn btn--primary">Iniciar un cambio o devolución</a>
      </p>
    </div>
</section>

@endsection