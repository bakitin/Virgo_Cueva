  @extends('layouts.app')

  @section( 'contenido')


<section class="page-header">
    <div class="container">
      <span class="eyebrow">¿Dudas?</span>
      <h1>Preguntas frecuentes</h1>
      <p>Si no encuentras tu respuesta acá, escríbenos directo por <a href="/contacto" style="color:var(--primary)">contacto</a>.</p>
    </div>
  </section>

  <section class="faq" style="padding-top:32px">
    <div class="container">

      <div class="faq__group">
        <h2>Envíos</h2>
        <div class="faq__list">
          <div class="faq-item">
            <button class="faq-item__question">¿Cuánto demora el envío? <span>+</span></button>
            <div class="faq-item__answer"><p>Dentro de Cali, 24-48 horas hábiles. A otras ciudades, entre 3 y 5 días hábiles.</p></div>
          </div>
          <div class="faq-item">
            <button class="faq-item__question">¿Hacen envíos a toda Colombia? <span>+</span></button>
            <div class="faq-item__answer"><p>Sí, a través de couriers asociados llegamos a todas las regiones del país.</p></div>
          </div>
          <div class="faq-item">
            <button class="faq-item__question">¿Puedo retirar en tienda? <span>+</span></button>
            <div class="faq-item__answer"><p>Sí, sin costo, en nuestra bodega en Cali. Te avisamos apenas tu pedido esté listo.</p></div>
          </div>
        </div>
      </div>

      <div class="faq__group">
        <h2>Pagos</h2>
        <div class="faq__list">
          <div class="faq-item">
            <button class="faq-item__question">¿Qué medios de pago aceptan? <span>+</span></button>
            <div class="faq-item__answer"><p>Tarjetas de crédito, débito, transferencia bancaria y pasarelas en línea. Más detalle en <a href="/pago_seguro" style="color:var(--primary)">pago seguro</a>.</p></div>
          </div>
          <div class="faq-item">
            <button class="faq-item__question">¿Puedo pagar en cuotas? <span>+</span></button>
            <div class="faq-item__answer"><p>Sí, hasta 3 cuotas sin interés con tarjetas de crédito participantes.</p></div>
          </div>
        </div>
      </div>

      <div class="faq__group">
        <h2>Garantía y devoluciones</h2>
        <div class="faq__list">
          <div class="faq-item">
            <button class="faq-item__question">¿Los productos tienen garantía? <span>+</span></button>
            <div class="faq-item__answer"><p>Sí, todos cuentan con garantía oficial. Los plazos exactos están en <a href="/garantia" style="color:var(--primary)">garantía</a>.</p></div>
          </div>
          <div class="faq-item">
            <button class="faq-item__question">¿Puedo cambiar un producto si no me convenció? <span>+</span></button>
            <div class="faq-item__answer"><p>Sí, tienes 10 días corridos desde que lo recibes. Revisa el detalle en <a href="/cambios_devoluciones" style="color:var(--primary)">cambios y devoluciones</a>.</p></div>
          </div>
        </div>
      </div>

      <div class="faq__group">
        <h2>Mi cuenta</h2>
        <div class="faq__list">
          <div class="faq-item">
            <button class="faq-item__question">¿Necesito una cuenta para comprar? <span>+</span></button>
            <div class="faq-item__answer"><p>No es obligatorio, pero si <a href="/nuevou" style="color:var(--primary)">creas una cuenta</a> guardamos tus datos de envío y el historial de pedidos.</p></div>
          </div>
          <div class="faq-item">
            <button class="faq-item__question">Olvidé mi contraseña, ¿qué hago? <span>+</span></button>
            <div class="faq-item__answer"><p>En la página de <a href="/login" style="color:var(--primary)">inicio de sesión</a> hay un link para recuperarla con tu correo.</p></div>
          </div>
        </div>
      </div>

    </div>
  </section>

  @endsection