<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Product;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class OfertasControllerTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_offers_page_lists_only_active_products_on_sale(): void
    {
        Product::factory()->onSale()->create(['name' => 'Audífonos rebajados']);
        Product::factory()->create(['name' => 'Audífonos a precio normal']);
        Product::factory()->onSale()->inactive()->create(['name' => 'Audífonos ocultos']);

        $response = $this->get(route('ofertas'));

        $response->assertOk();
        $response->assertSee('Audífonos rebajados');
        $response->assertDontSee('Audífonos a precio normal');
        $response->assertDontSee('Audífonos ocultos');
    }

    public function test_countdown_shows_the_time_left_until_sunday_night(): void
    {
        $this->travelTo('2026-10-19 08:00:00');

        $response = $this->get(route('ofertas'));

        $response->assertOk();
        $response->assertSeeInOrder([
            '<strong>06</strong><span>Días</span>',
            '<strong>15</strong><span>Horas</span>',
            '<strong>59</strong><span>Min</span>',
        ], false);
    }
}
