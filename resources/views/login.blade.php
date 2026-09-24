@extends('layouts.app')

@section('contenido')


<section class="form-page">
    <div class="container">
      <div class="form-card">
        <h1>Bienvenido de vuelta</h1>
        <p class="form-card__sub">Ingresa para ver tus pedidos y datos guardados.</p>

        <form class="js-demo-form" data-success-msg="Sesión iniciada. (Formulario de ejemplo, falta conectar un backend real).">
          <label for="login-email">Correo</label>
          <input type="email" id="login-email" placeholder="tu@correo.com" required>

          <label for="login-pass">Contraseña</label>
          <input type="password" id="login-pass" placeholder="••••••••" required>

          <div class="form-card__row">
            <label style="display:flex; align-items:center; gap:6px; margin:0;">
              <input type="checkbox" style="width:auto"> Recordarme
            </label>
            <a href="#">¿Olvidaste tu contraseña?</a>
          </div>

          <button type="submit" class="btn btn--primary btn--block">Iniciar sesión</button>
          <div class="form-message"></div>
        </form>

        <div class="divider">o</div>
        <button type="button" class="btn btn--ghost btn--block">Continuar con Google</button>

        <p class="form-card__footer">¿Aún no tienes cuenta? <a href="/nuevou">Regístrate gratis</a></p>
      </div>
    </div>
  </section>

  @endsection