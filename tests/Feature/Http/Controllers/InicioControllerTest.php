<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class InicioControllerTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_home_links_every_category_to_its_filtered_catalog(): void
    {
        Category::factory()->create(['name' => 'Teclados', 'slug' => 'teclados']);

        $response = $this->get(route('inicio'));

        $response->assertOk();
        $response->assertSee('Teclados');
        $response->assertSee(route('productos.index', ['categoria' => 'teclados']), false);
    }

    public function test_home_shows_only_active_featured_products(): void
    {
        Product::factory()->featured()->create(['name' => 'Teclado destacado']);
        Product::factory()->create(['name' => 'Teclado normal']);
        Product::factory()->featured()->inactive()->create(['name' => 'Teclado oculto']);

        $response = $this->get(route('inicio'));

        $response->assertOk();
        $response->assertSee('Teclado destacado');
        $response->assertDontSee('Teclado normal');
        $response->assertDontSee('Teclado oculto');
    }
}
