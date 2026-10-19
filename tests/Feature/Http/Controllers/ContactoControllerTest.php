<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class ContactoControllerTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_contact_page_lists_every_reason(): void
    {
        $response = $this->get(route('contacto'));

        $response->assertOk();
        $response->assertSeeInOrder(ContactMessage::REASONS);
    }

    public function test_a_valid_message_is_saved_and_confirmed(): void
    {
        $response = $this->post(route('contacto'), [
            'name' => 'Camila Rojas',
            'email' => 'camila@example.com',
            'reason' => 'Garantía',
            'message' => 'Mi mouse dejó de funcionar.',
        ]);

        $response->assertRedirect(route('contacto'));
        $response->assertSessionHas('status', '¡Gracias por escribirnos! Recibimos tu mensaje y te responderemos pronto.');
        $this->assertDatabaseHas('contact_messages', [
            'name' => 'Camila Rojas',
            'email' => 'camila@example.com',
            'reason' => 'Garantía',
            'message' => 'Mi mouse dejó de funcionar.',
        ]);
    }

    public function test_an_empty_message_is_rejected_with_spanish_errors(): void
    {
        $response = $this->post(route('contacto'), []);

        $response->assertSessionHasErrors([
            'name' => 'El campo nombre es obligatorio.',
            'email' => 'El campo correo es obligatorio.',
            'reason' => 'El campo motivo es obligatorio.',
            'message' => 'El campo mensaje es obligatorio.',
        ]);
        $this->assertDatabaseCount('contact_messages', 0);
    }

    public function test_a_reason_outside_the_list_is_rejected(): void
    {
        $response = $this->post(route('contacto'), [
            'name' => 'Camila Rojas',
            'email' => 'camila@example.com',
            'reason' => 'Quiero trabajar con ustedes',
            'message' => 'Hola.',
        ]);

        $response->assertSessionHasErrors(['reason' => 'El motivo seleccionado no es válido.']);
        $this->assertDatabaseCount('contact_messages', 0);
    }
}
