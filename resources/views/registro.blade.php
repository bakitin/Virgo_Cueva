@extends('layouts.app')

@section('titulo', 'Crear cuenta')

@section('contenido')

    <section class="form-page">
        <div class="container">
            <div class="form-card">
                <h1>Crea tu cuenta</h1>
                <p class="form-card__sub">Toma menos de un minuto y te sirve para tu próxima compra.</p>

                <form method="POST" action="{{ route('registro') }}">
                    @csrf

                    <label for="reg-nombre">Nombre completo</label>
                    <input type="text" id="reg-nombre" name="name" value="{{ old('name') }}" placeholder="Tu nombre" required autocomplete="name">
                    @error('name')
                        <p class="form-error">{{ $message }}</p>
                    @enderror

                    <label for="reg-email">Correo</label>
                    <input type="email" id="reg-email" name="email" value="{{ old('email') }}" placeholder="tu@correo.com" required autocomplete="email">
                    @error('email')
                        <p class="form-error">{{ $message }}</p>
                    @enderror

                    <label for="reg-pass">Contraseña</label>
                    <input type="password" id="reg-pass" name="password" placeholder="Mínimo 8 caracteres" required minlength="8" autocomplete="new-password">
                    @error('password')
                        <p class="form-error">{{ $message }}</p>
                    @enderror

                    <label for="reg-pass2">Confirmar contraseña</label>
                    <input type="password" id="reg-pass2" name="password_confirmation" placeholder="Repite tu contraseña" required minlength="8" autocomplete="new-password">

                    <div class="form-card__checkbox">
                        <input type="checkbox" name="terms" value="1" style="width:auto" required @checked(old('terms'))>
                        <span>Acepto los <a href="#" style="color:var(--primary)">términos y condiciones</a> y la política de privacidad.</span>
                    </div>
                    @error('terms')
                        <p class="form-error">{{ $message }}</p>
                    @enderror

                    <button type="submit" class="btn btn--primary btn--block">Crear cuenta</button>
                </form>

                <p class="form-card__footer">¿Ya tienes cuenta? <a href="{{ route('login') }}">Inicia sesión</a></p>
            </div>
        </div>
    </section>

@endsection
