<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RegistroControllerTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_visitor_registers_and_is_logged_in(): void
    {
        $response = $this->post(route('registro'), [
            'name' => 'Camila Rojas',
            'email' => 'camila@example.com',
            'password' => 'clave-segura',
            'password_confirmation' => 'clave-segura',
            'terms' => '1',
        ]);

        $response->assertRedirect(route('inicio'));
        $response->assertSessionHas('status', '¡Bienvenido, Camila Rojas! Tu cuenta quedó creada.');
        $user = User::where('email', 'camila@example.com')->sole();
        $this->assertSame('Camila Rojas', $user->name);
        $this->assertTrue(Hash::check('clave-segura', $user->password));
        $this->assertAuthenticatedAs($user);
    }

    public function test_an_email_that_already_has_an_account_is_rejected(): void
    {
        User::factory()->create(['email' => 'camila@example.com']);

        $response = $this->post(route('registro'), [
            'name' => 'Camila Rojas',
            'email' => 'camila@example.com',
            'password' => 'clave-segura',
            'password_confirmation' => 'clave-segura',
            'terms' => '1',
        ]);

        $response->assertSessionHasErrors(['email' => 'Ese correo ya está registrado.']);
        $this->assertDatabaseCount('users', 1);
        $this->assertGuest();
    }

    public function test_password_confirmation_must_match(): void
    {
        $response = $this->post(route('registro'), [
            'name' => 'Camila Rojas',
            'email' => 'camila@example.com',
            'password' => 'clave-segura',
            'password_confirmation' => 'otra-clave',
            'terms' => '1',
        ]);

        $response->assertSessionHasErrors(['password' => 'La confirmación de contraseña no coincide.']);
        $this->assertDatabaseCount('users', 0);
    }

    public function test_password_needs_at_least_eight_characters(): void
    {
        $response = $this->post(route('registro'), [
            'name' => 'Camila Rojas',
            'email' => 'camila@example.com',
            'password' => 'corta',
            'password_confirmation' => 'corta',
            'terms' => '1',
        ]);

        $response->assertSessionHasErrors(['password' => 'El campo contraseña debe tener al menos 8 caracteres.']);
        $this->assertDatabaseCount('users', 0);
    }

    public function test_terms_must_be_accepted(): void
    {
        $response = $this->post(route('registro'), [
            'name' => 'Camila Rojas',
            'email' => 'camila@example.com',
            'password' => 'clave-segura',
            'password_confirmation' => 'clave-segura',
        ]);

        $response->assertSessionHasErrors(['terms' => 'Debes aceptar los términos y condiciones.']);
        $this->assertDatabaseCount('users', 0);
    }
}
