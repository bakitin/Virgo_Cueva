  @extends('layouts.app')

  @section( 'contenido')


<section class="page-header">
    <div class="container">
      <span class="eyebrow">Compra con confianza</span>
      <h1>Garantía y soporte</h1>
      <p>Nada de correos que nadie responde. Así funciona la garantía en La Virgo Cueva.</p>
    </div>
  </section>

  <section class="policy" style="padding-top:32px">
    <div class="container">
      <div class="warranty__grid">
        <div class="warranty-card">
          <svg class="icon" viewBox="0 0 24 24"><path d="M12 3l7 3v5c0 5-3.4 8.6-7 10-3.6-1.4-7-5-7-10V6z"/><path d="M9 12l2 2 4-4.5"/></svg>
          <h3>Garantía de fábrica</h3>
          <p>Entre 6 y 24 meses según el fabricante, detallada en la ficha de cada producto.</p>
        </div>
        <div class="warranty-card">
          <svg class="icon" viewBox="0 0 24 24"><path d="M14.7 6.3a4 4 0 0 1-5.4 5.4L4.5 16.5l3 3L12.3 14a4 4 0 0 1 5.4-5.4l-3-2.3z"/></svg>
          <h3>Soporte técnico real</h3>
          <p>Te ayudamos a instalar, configurar o diagnosticar una falla antes de mandar nada de vuelta.</p>
        </div>
        <div class="warranty-card">
          <svg class="icon" viewBox="0 0 24 24"><path d="M21 8l-9-5-9 5 9 5 9-5z"/><path d="M3 8v8l9 5 9-5V8"/><path d="M12 13v8"/></svg>
          <h3>Retiro o envío del equipo</h3>
          <p>Si el producto necesita revisión, coordinamos retiro o envío del equipo sin costo para ti.</p>
        </div>
        <div class="warranty-card">
          <svg class="icon" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M8 12l2.5 2.5L16 9"/></svg>
          <h3>100% producto original</h3>
          <p>Trabajamos solo con distribuidores autorizados. Nunca réplicas, nunca productos "genéricos".</p>
        </div>
      </div>
    </div>
  </section>

  <section class="policy">
    <div class="container">
      <h2 class="section-title">Plazos por categoría</h2>
      <table class="policy-table">
        <thead>
          <tr><th>Categoría</th><th>Garantía</th><th>Cubre</th></tr>
        </thead>
        <tbody>
          <tr><td>Teclados y mouses</td><td>12 meses</td><td>Fallas de fábrica, switches, sensores</td></tr>
          <tr><td>Audífonos</td><td>6 meses</td><td>Fallas de audio, micrófono, batería (inalámbricos)</td></tr>
          <tr><td>Monitores</td><td>24 meses</td><td>Panel, píxeles muertos (según norma del fabricante), fuente de poder</td></tr>
          <tr><td>Sillas gamer</td><td>18 meses</td><td>Estructura, pistón a gas, mecanismo de reclinado</td></tr>
          <tr><td>Accesorios (mousepads, hubs, soportes)</td><td>3 meses</td><td>Defectos de fabricación</td></tr>
        </tbody>
      </table>
    </div>
  </section>

  <section class="policy">
    <div class="container">
      <h2 class="section-title">Cómo hacer válida la garantía</h2>
      <div class="steps">
        <div class="step">
          <div class="step__num"></div>
          <div><h3>Escríbenos</h3><p>Cuéntanos qué pasa por WhatsApp o correo, con tu número de pedido a mano.</p></div>
        </div>
        <div class="step">
          <div class="step__num"></div>
          <div><h3>Diagnóstico rápido</h3><p>Te pedimos fotos o un video corto para descartar algo que se resuelve sin envíos.</p></div>
        </div>
        <div class="step">
          <div class="step__num"></div>
          <div><h3>Retiro o envío</h3><p>Si corresponde, coordinamos el retiro del producto o te damos una guía de envío prepagada.</p></div>
        </div>
        <div class="step">
          <div class="step__num"></div>
          <div><h3>Reparación o cambio</h3><p>Según el caso, reparamos, cambiamos por uno nuevo o devolvemos tu dinero.</p></div>
        </div>
      </div>
      <p style="text-align:center; margin-top:36px">
        <a href="/contacto" class="btn btn--primary">Hacer válida mi garantía</a>
      </p>
    </div>
  </section>

    @endsection