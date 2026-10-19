<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductSpec;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class ProductoControllerTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_catalog_lists_only_active_products(): void
    {
        Product::factory()->create(['name' => 'Mouse visible']);
        Product::factory()->inactive()->create(['name' => 'Mouse oculto']);

        $response = $this->get(route('productos.index'));

        $response->assertOk();
        $response->assertSee('Mouse visible');
        $response->assertDontSee('Mouse oculto');
    }

    public function test_catalog_filters_by_category_and_marks_the_active_filter(): void
    {
        $gpus = Category::factory()->create(['name' => 'Tarjetas de video', 'slug' => 'gpu']);
        Product::factory()->for($gpus)->create(['name' => 'RTX 5070']);
        Product::factory()->create(['name' => 'Silla gamer']);

        $response = $this->get(route('productos.index', ['categoria' => 'gpu']));

        $response->assertOk();
        $response->assertSee('RTX 5070');
        $response->assertDontSee('Silla gamer');
        $response->assertSee('class="filter-btn is-active">Tarjetas de video', false);
    }

    public function test_catalog_search_matches_the_product_name(): void
    {
        Product::factory()->create(['name' => 'Razer Viper V3']);
        Product::factory()->create(['name' => 'Logitech G305']);

        $response = $this->get(route('productos.index', ['buscar' => 'viper']));

        $response->assertOk();
        $response->assertSee('Razer Viper V3');
        $response->assertDontSee('Logitech G305');
    }

    public function test_catalog_search_matches_the_brand_name(): void
    {
        $razer = Brand::factory()->create(['name' => 'Razer']);
        Product::factory()->for($razer)->create(['name' => 'Viper V3']);
        Product::factory()->create(['name' => 'G305 Lightspeed']);

        $response = $this->get(route('productos.index', ['buscar' => 'razer']));

        $response->assertOk();
        $response->assertSee('Viper V3');
        $response->assertDontSee('G305 Lightspeed');
    }

    public function test_catalog_shows_a_message_when_no_product_matches(): void
    {
        Product::factory()->create();

        $response = $this->get(route('productos.index', ['categoria' => 'no-existe']));

        $response->assertOk();
        $response->assertSee('No encontramos productos con esos filtros.');
    }

    public function test_catalog_escapes_the_search_term(): void
    {
        $response = $this->get(route('productos.index', ['buscar' => '<script>alert(1)</script>']));

        $response->assertOk();
        $response->assertDontSee('<script>alert(1)</script>', false);
        $response->assertSee('&lt;script&gt;alert(1)&lt;/script&gt;', false);
    }

    public function test_product_page_shows_prices_specs_and_related_products(): void
    {
        $mouses = Category::factory()->create();
        $product = Product::factory()->for($mouses)->create([
            'name' => 'Razer Viper V3',
            'price' => 286900,
            'old_price' => 329900,
        ]);
        ProductSpec::factory()->for($product)->create(['value' => 'Sensor de 30.000 DPI']);
        Product::factory()->for($mouses)->create(['name' => 'Logitech G305']);
        Product::factory()->create(['name' => 'Silla gamer']);

        $response = $this->get(route('productos.show', $product));

        $response->assertOk();
        $response->assertSee('<title>Razer Viper V3 | Virgo Cueva</title>', false);
        $response->assertSee('$286.900');
        $response->assertSee('$329.900');
        $response->assertSee('Sensor de 30.000 DPI');
        $response->assertSee('action="'.route('carrito.store', $product).'"', false);
        $response->assertSee('Logitech G305');
        $response->assertDontSee('Silla gamer');
    }

    public function test_product_page_is_not_found_for_an_inactive_product(): void
    {
        $product = Product::factory()->inactive()->create();

        $response = $this->get(route('productos.show', $product));

        $response->assertNotFound();
    }

    public function test_unknown_product_shows_the_store_not_found_page(): void
    {
        $response = $this->get('/productos/no-existe');

        $response->assertNotFound();
        $response->assertSee('No encontramos lo que buscas');
    }
}
