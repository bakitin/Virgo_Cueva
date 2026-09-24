   @extends('layouts.app')

  @section( 'contenido')
 
 <section class="page-header">
    <div class="container">
      <span class="eyebrow">Quiénes somos</span>
      <h1>Empezamos en un living, literal</h1>
      <p>La historia corta de cómo una pieza llena de cajas terminó siendo una tienda.</p>
    </div>
  </section>

  <section class="about">
    <div class="container about__inner">
      <div class="about__media">
        <!-- IMG: foto informal del equipo trabajando, no stock -->
        <img src="{{ asset('images/logo/nosotros-equipo.jpg') }}" alt="Equipo de La Virgo Cueva">
      </div>
      <div class="about__text">
        <h2 class="section-title section-title--left">De reventa entre amigos a tienda de verdad</h2>
        <p>
          En 2019, Tomás compraba mouses por volumen para revendérselos a compañeros de la
          universidad. Su pieza terminó pareciendo una bodega. Cuando Camila se sumó en 2020,
          decidimos hacerlo en serio: catálogo, garantía por escrito y un compromiso simple
          con nosotros mismos: no vender nada que no usaríamos en nuestro propio setup.
        </p>
        <p>
          Seis años después seguimos siendo un equipo chico. Eso significa que cuando escribes
          por WhatsApp, te responde alguien que sabe de qué está hablando, no un script.
        </p>
      </div>
    </div>
  </section>

  <section class="policy" style="padding-top:0">
    <div class="container">
      <h2 class="section-title">Cómo llegamos hasta acá</h2>
      <div class="timeline">
        <div class="timeline-item">
          <span>2019</span>
          <h3>La pieza-bodega</h3>
          <p>Primeras ventas informales entre compañeros de universidad. Todo se coordinaba por WhatsApp.</p>
        </div>
        <div class="timeline-item">
          <span>2020</span>
          <h3>Se arma el equipo</h3>
          <p>Camila se suma, armamos catálogo básico y definimos la política de garantía que usamos hasta hoy.</p>
        </div>
        <div class="timeline-item">
          <span>2021</span>
          <h3>Primera bodega real</h3>
          <p>Dejamos el living y arrendamos un espacio para guardar stock y despachar más rápido.</p>
        </div>
        <div class="timeline-item">
          <span>2023</span>
          <h3>Envíos a toda Colombia</h3>
          <p>Sumamos couriers asociados para llegar a regiones en días hábiles razonables.</p>
        </div>
        <div class="timeline-item">
          <span>2026</span>
          <h3>Hoy</h3>
          <p>Somos 7 personas, seguimos probando cada producto antes de venderlo y esta página web recién se puso al día.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="policy">
    <div class="container">
      <h2 class="section-title">Lo que no negociamos</h2>
      <div class="values__grid">
        <div class="value-card">
          <h3>Probamos antes de vender</h3>
          <p>Si un producto no aguanta un mes de uso real en nuestras propias manos, no entra al catálogo.</p>
        </div>
        <div class="value-card">
          <h3>Garantía sin letra chica</h3>
          <p>Los plazos están publicados en la página de garantía, no escondidos en un correo.</p>
        </div>
        <div class="value-card">
          <h3>Precio justo, no el más barato</h3>
          <p>No competimos por ser los más baratos del mercado, sino por vender cosas que valen lo que cuestan.</p>
        </div>
        <div class="value-card">
          <h3>Respuesta humana</h3>
          <p>Nada de respuestas automáticas eternas: alguien del equipo lee y contesta tus mensajes.</p>
        </div>
      </div>
    </div>
  </section>

    @endsection