   @extends('layouts.app')

  @section( 'contenido')
  
 <section class="page-header">
    <div class="container">
      <span class="eyebrow">Hablemos</span>
      <h1>Contáctanos</h1>
      <p>¿Dudas sobre un producto, tu pedido o una garantía? Te respondemos nosotros, no un bot.</p>
    </div>
  </section>

  <section class="contact" style="padding-top:32px">
    <div class="container contact__inner">
      <div class="contact__info">
        <h2 class="section-title section-title--left">Nuestros datos</h2>
        <ul class="contact__list">
          <li><svg class="icon" viewBox="0 0 24 24"><path d="M12 21s7-6.5 7-12a7 7 0 0 0-14 0c0 5.5 7 12 7 12z"/><circle cx="12" cy="9" r="2.5"/></svg> Calle 5 #38-45, Barrio San Fernando, Cali</li>
          <li><svg class="icon" viewBox="0 0 24 24"><path d="M6 3h3l2 5-2.5 1.8a12 12 0 0 0 5.7 5.7L15.8 13l5 2v3a2 2 0 0 1-2 2C10.5 20 4 13.5 4 5a2 2 0 0 1 2-2z"/></svg> +57 300 123 4567</li>
          <li><svg class="icon" viewBox="0 0 24 24"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M3 6l9 7 9-7"/></svg> hola@lavirgocueva.co</li>
          <li><svg class="icon" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3.5 2"/></svg> Lunes a sábado, 10:00 a 19:00</li>
        </ul>
        <div class="contact__social">
          <a href="#" aria-label="Instagram">IG</a>
          <a href="#" aria-label="TikTok">TT</a>
          <a href="#" aria-label="WhatsApp">WA</a>
        </div>
      </div>

      <form class="contact__form">
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" placeholder="Tu nombre" required>

        <label for="email">Correo</label>
        <input type="email" id="email" name="email" placeholder="tu@correo.com" required>

        <label for="motivo">Motivo</label>
        <select id="motivo" name="motivo">
          <option>Consulta sobre un producto</option>
          <option>Garantía</option>
          <option>Cambio o devolución</option>
          <option>Estado de mi pedido</option>
          <option>Otro</option>
        </select>

        <label for="mensaje">Mensaje</label>
        <textarea id="mensaje" name="mensaje" rows="5" placeholder="Escribe tu mensaje" required></textarea>

        <button type="submit" class="btn btn--primary">Enviar mensaje</button>
      </form>
    </div>

    <div class="contact__map">
      <!-- IMG: captura de mapa (Google Maps) o iframe de mapa embebido -->
      <img src="{{ asset('images/logo/mapa-ubicacion.jpg')  }} alt="Mapa de ubicación de la tienda">
    </div>
  </section>

   @endsection