  @extends('layouts.app')

  @section( 'contenido')

<section class="page-header">
    <div class="container">
      <span class="eyebrow">Tu carrito</span>
      <h1>Revisa antes de pagar</h1>
      <p>Estos productos son solo un ejemplo de cómo se ve el carrito.</p>
    </div>
  </section>

  <section class="cart">
    <div class="container">

      <div id="cart-content" class="cart__inner">
        <div class="cart-items">

          <div class="cart-item" data-price="574900">
            <img src="/images/teclados/AZER_TKL_BLACWIDOW_V4_1.webp" alt="Razer BlackWidow V4 TKL">
            <div>
              <h3>Razer BlackWidow V4 TKL</h3>
              <p>Switches clicky · Formato TKL</p>
              <div class="cart-item__qty">
                <button class="cart-item__qty-less" aria-label="Restar">−</button>
                <span class="cart-item__qty-value">1</span>
                <button class="cart-item__qty-more" aria-label="Sumar">+</button>
              </div>
              <button class="cart-item__remove">Eliminar</button>
            </div>
            <div class="cart-item__price">$574.900</div>
          </div>

          <div class="cart-item" data-price="286900">
            <img src="/images/mouses/VIPER_V3_HYPERSPEED_1.webp" alt="Razer Viper V3 HyperSpeed">
            <div>
              <h3>Razer Viper V3 HyperSpeed</h3>
              <p>30.000 DPI · Inalámbrico</p>
              <div class="cart-item__qty">
                <button class="cart-item__qty-less" aria-label="Restar">−</button>
                <span class="cart-item__qty-value">1</span>
                <button class="cart-item__qty-more" aria-label="Sumar">+</button>
              </div>
              <button class="cart-item__remove">Eliminar</button>
            </div>
            <div class="cart-item__price">$286.900</div>
          </div>

        </div>

        <aside class="cart-summary">
          <h3>Resumen</h3>
          <div class="cart-summary__row"><span>Subtotal</span><span id="cart-subtotal">$0</span></div>
          <div class="cart-summary__row"><span>Envío</span><span>$17.900</span></div>
          <div class="cart-summary__row cart-summary__row--total"><span>Total</span><span id="cart-total">$0</span></div>
          <button class="btn btn--primary btn--block" style="margin-top:20px">Ir a pagar</button>
          <p style="text-align:center; margin-top:14px">
            <a href="/productos" style="color:var(--text-muted); font-size:.85rem;">Seguir comprando</a>
          </p>
        </aside>
      </div>

      <div id="cart-empty" class="cart-empty" style="display:none">
        <svg class="icon" viewBox="0 0 24 24"><circle cx="9" cy="20" r="1.4"/><circle cx="17" cy="20" r="1.4"/><path d="M2.5 3h2.4l2.1 11a2 2 0 0 0 2 1.6h7.4a2 2 0 0 0 2-1.6L20 7.5H6"/></svg>
        <h3>Tu carrito está vacío</h3>
        <p style="color:var(--text-muted); margin:10px 0 24px">Todavía no has agregado productos.</p>
        <a href="/productos" class="btn btn--primary">Ver productos</a>
      </div>

    </div>
  </section>

  
  @endsection