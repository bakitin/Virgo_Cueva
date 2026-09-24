  @extends('layouts.app')

  @section( 'contenido')
  
<section class="page-header">
    <div class="container">
      <span class="eyebrow">Tu compra, protegida</span>
      <h1>Pago 100% seguro</h1>
      <p>Tus datos de pago nunca pasan por nuestros servidores. Así protegemos cada transacción.</p>
    </div>
  </section>

  <section class="policy" style="padding-top:32px">
    <div class="container">
      <h2 class="section-title">Medios de pago</h2>
      <div class="payment-methods" style="justify-content:center">
        <span class="payment-badge"><svg class="icon" viewBox="0 0 24 24"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg> Tarjeta de crédito</span>
        <span class="payment-badge"><svg class="icon" viewBox="0 0 24 24"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg> Tarjeta de débito</span>
        <span class="payment-badge"><svg class="icon" viewBox="0 0 24 24"><path d="M4 4v6h6"/><path d="M20 20v-6h-6"/><path d="M5.5 15A8 8 0 0 0 19 17.5"/><path d="M18.5 9A8 8 0 0 0 5 6.5"/></svg> Transferencia bancaria</span>
        <span class="payment-badge"><svg class="icon" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M8 12l2.5 2.5L16 9"/></svg> Pasarelas en línea (PSE, Mercado Pago)</span>
        <span class="payment-badge"><svg class="icon" viewBox="0 0 24 24"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg> Hasta 3 cuotas sin interés</span>
      </div>
    </div>
  </section>

  <section class="policy">
    <div class="container">
      <h2 class="section-title">Cómo protegemos tu pago</h2>
      <div class="warranty__grid">
        <div class="warranty-card">
          <svg class="icon" viewBox="0 0 24 24"><path d="M12 3l7 3v5c0 5-3.4 8.6-7 10-3.6-1.4-7-5-7-10V6z"/><path d="M9 12l2 2 4-4.5"/></svg>
          <h3>Conexión encriptada</h3>
          <p>Todo el proceso de pago corre bajo certificado SSL, de punta a punta.</p>
        </div>
        <div class="warranty-card">
          <svg class="icon" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-6.5 8-6.5s8 2.5 8 6.5"/></svg>
          <h3>No guardamos tu tarjeta</h3>
          <p>El cobro lo procesa directamente la pasarela de pago. Nosotros nunca vemos ni almacenamos tus datos.</p>
        </div>
        <div class="warranty-card">
          <svg class="icon" viewBox="0 0 24 24"><path d="M21 8l-9-5-9 5 9 5 9-5z"/><path d="M3 8v8l9 5 9-5V8"/><path d="M12 13v8"/></svg>
          <h3>Confirmación inmediata</h3>
          <p>Recibes un correo apenas se procesa el pago, con el detalle de tu pedido.</p>
        </div>
        <div class="warranty-card">
          <svg class="icon" viewBox="0 0 24 24"><path d="M14.7 6.3a4 4 0 0 1-5.4 5.4L4.5 16.5l3 3L12.3 14a4 4 0 0 1 5.4-5.4l-3-2.3z"/></svg>
          <h3>Soporte si algo falla</h3>
          <p>¿El pago se cae o queda "pendiente"? Escríbenos y lo revisamos al tiro, sin cobros dobles.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="policy">
    <div class="container">
      <h2 class="section-title">Preguntas rápidas</h2>
      <div class="faq__list" style="max-width:760px; margin:0 auto;">
        <div class="faq-item">
          <button class="faq-item__question">¿Puedo pagar contra entrega? <span>+</span></button>
          <div class="faq-item__answer"><p>Por ahora no, todos los pagos se procesan antes del despacho para evitar fraudes.</p></div>
        </div>
        <div class="faq-item">
          <button class="faq-item__question">¿Qué pasa si me cobran dos veces? <span>+</span></button>
          <div class="faq-item__answer"><p>Escríbenos apenas lo notes con tu comprobante; el reverso lo gestionamos directo con la pasarela.</p></div>
        </div>
        <div class="faq-item">
          <button class="faq-item__question">¿Emiten factura electrónica? <span>+</span></button>
          <div class="faq-item__answer"><p>Sí, la factura electrónica llega a tu correo apenas se confirma el pago.</p></div>
        </div>
      </div>
    </div>
  </section>

  @endsection