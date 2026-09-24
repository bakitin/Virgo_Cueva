   @extends('layouts.app')

  @section( 'contenido')

   <section class="form-page">
    <div class="container">
      <div class="form-card">
        <h1>Crea tu cuenta</h1>
        <p class="form-card__sub">Toma menos de un minuto y te sirve para tu próxima compra.</p>

        <form class="js-demo-form" data-success-msg="Cuenta creada. (Formulario de ejemplo, falta conectar un backend real).">
          <label for="reg-nombre">Nombre completo</label>
          <input type="text" id="reg-nombre" placeholder="Tu nombre" required>

          <label for="reg-email">Correo</label>
          <input type="email" id="reg-email" placeholder="tu@correo.com" required>

          <label for="reg-pass">Contraseña</label>
          <input type="password" id="reg-pass" placeholder="Mínimo 8 caracteres" required minlength="8">

          <label for="reg-pass2">Confirmar contraseña</label>
          <input type="password" id="reg-pass2" placeholder="Repite tu contraseña" required minlength="8">

          <div class="form-card__checkbox">
            <input type="checkbox" style="width:auto" required>
            <span>Acepto los <a href="#" style="color:var(--primary)">términos y condiciones</a> y la política de privacidad.</span>
          </div>

          <button type="submit" class="btn btn--primary btn--block">Crear cuenta</button>
          <div class="form-message"></div>
        </form>

        <p class="form-card__footer">¿Ya tienes cuenta? <a href="/login">Inicia sesión</a></p>
      </div>
    </div>
  </section>

   @endsection