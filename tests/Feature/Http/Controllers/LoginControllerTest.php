<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_user_logs_in_with_valid_credentials(): void
    {
        $user = User::factory()->create(['email' => 'tomas@example.com']);

        $response = $this->post(route('login'), [
            'email' => 'tomas@example.com',
            'password' => 'password',
        ]);

        $response->assertRedirect(route('inicio'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_wrong_password_is_rejected_with_a_spanish_message(): void
    {
        User::factory()->create(['email' => 'tomas@example.com']);

        $response = $this->post(route('login'), [
            'email' => 'tomas@example.com',
            'password' => 'otra-clave',
        ]);

        $response->assertSessionHasErrors(['email' => 'El correo o la contraseña no son correctos.']);
        $this->assertGuest();
    }

    public function test_login_is_blocked_after_five_failed_attempts(): void
    {
        $this->freezeTime();
        User::factory()->create(['email' => 'tomas@example.com']);

        for ($attempt = 1; $attempt <= 5; $attempt++) {
            $this->post(route('login'), ['email' => 'tomas@example.com', 'password' => 'otra-clave']);
        }

        $response = $this->post(route('login'), ['email' => 'tomas@example.com', 'password' => 'password']);

        $response->assertSessionHasErrors(['email' => 'Demasiados intentos de inicio de sesión. Intenta de nuevo en 60 segundos.']);
        $this->assertGuest();
    }

    public function test_logged_in_user_is_sent_home_from_the_login_page(): void
    {
        $response = $this->actingAs(User::factory()->create())->get(route('login'));

        $response->assertRedirect('/');
    }

    public function test_user_logs_out(): void
    {
        $response = $this->actingAs(User::factory()->create())->post(route('logout'));

        $response->assertRedirect(route('inicio'));
        $this->assertGuest();
    }

    public function test_guest_logout_request_redirects_to_login(): void
    {
        $response = $this->post(route('logout'));

        $response->assertRedirect(route('login'));
    }

    public function test_header_greets_the_logged_in_user(): void
    {
        $response = $this->actingAs(User::factory()->create(['name' => 'Tomás']))->get(route('inicio'));

        $response->assertOk();
        $response->assertSee('Hola, Tomás');
        $response->assertSee('Cerrar sesión');
    }
}
