@extends('layouts.app')

@section('titulo', 'Iniciar sesión')

@section('contenido')

    <section class="form-page">
        <div class="container">
            <div class="form-card">
                <h1>Bienvenido de vuelta</h1>
                <p class="form-card__sub">Ingresa para ver tus pedidos y datos guardados.</p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <label for="login-email">Correo</label>
                    <input type="email" id="login-email" name="email" value="{{ old('email') }}" placeholder="tu@correo.com" required autofocus autocomplete="email">
                    @error('email')
                        <p class="form-error">{{ $message }}</p>
                    @enderror

                    <label for="login-pass">Contraseña</label>
                    <input type="password" id="login-pass" name="password" placeholder="••••••••" required autocomplete="current-password">
                    @error('password')
                        <p class="form-error">{{ $message }}</p>
                    @enderror

                    <div class="form-card__row">
                        <label style="display:flex; align-items:center; gap:6px; margin:0;">
                            <input type="checkbox" name="remember" style="width:auto"> Recordarme
                        </label>
                    </div>

                    <button type="submit" class="btn btn--primary btn--block">Iniciar sesión</button>
                </form>

                <p class="form-card__footer">¿Aún no tienes cuenta? <a href="{{ route('registro') }}">Regístrate gratis</a></p>
            </div>
        </div>
    </section>

@endsection
