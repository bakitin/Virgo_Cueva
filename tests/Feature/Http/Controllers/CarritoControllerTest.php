<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Product;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class CarritoControllerTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_adding_a_product_puts_it_in_the_session_cart(): void
    {
        $product = Product::factory()->create(['name' => 'Razer Viper V3']);

        $response = $this->post(route('carrito.store', $product));

        $response->assertRedirect(route('carrito.index'));
        $response->assertSessionHas('carrito', [$product->id => 1]);
        $response->assertSessionHas('status', 'Agregaste Razer Viper V3 al carrito.');
    }

    public function test_adding_a_product_already_in_the_cart_increases_its_quantity(): void
    {
        $product = Product::factory()->create();

        $response = $this->withSession(['carrito' => [$product->id => 2]])
            ->post(route('carrito.store', $product));

        $response->assertSessionHas('carrito', [$product->id => 3]);
    }

    public function test_adding_more_units_than_the_stock_is_rejected(): void
    {
        $product = Product::factory()->create(['name' => 'Silla Iskur', 'stock' => 1]);

        $response = $this->withSession(['carrito' => [$product->id => 1]])
            ->from(route('productos.show', $product))
            ->post(route('carrito.store', $product));

        $response->assertRedirect(route('productos.show', $product));
        $response->assertSessionHas('error', 'No quedan más unidades disponibles de Silla Iskur.');
        $response->assertSessionHas('carrito', [$product->id => 1]);
    }

    public function test_an_inactive_product_cannot_be_added(): void
    {
        $product = Product::factory()->inactive()->create();

        $response = $this->post(route('carrito.store', $product));

        $response->assertNotFound();
        $response->assertSessionMissing('carrito');
    }

    public function test_cart_page_shows_items_subtotal_shipping_and_total(): void
    {
        $keyboard = Product::factory()->create(['name' => 'Teclado Acira', 'price' => 198900]);
        $mouse = Product::factory()->create(['name' => 'Mouse G305', 'price' => 150000]);

        $response = $this->withSession(['carrito' => [$keyboard->id => 2, $mouse->id => 1]])
            ->get(route('carrito.index'));

        $response->assertOk();
        $response->assertSee('Teclado Acira');
        $response->assertSee('Mouse G305');
        $response->assertSee('$397.800');
        $response->assertSeeInOrder(['Subtotal', '$547.800', 'Envío', '$17.900', 'Total', '$565.700']);
        $response->assertSee('<span class="cart-count">3</span>', false);
    }

    public function test_cart_page_ignores_products_that_are_no_longer_active(): void
    {
        $product = Product::factory()->inactive()->create(['name' => 'Producto retirado']);

        $response = $this->withSession(['carrito' => [$product->id => 1]])
            ->get(route('carrito.index'));

        $response->assertOk();
        $response->assertDontSee('Producto retirado');
        $response->assertSee('Tu carrito está vacío');
    }

    public function test_empty_cart_shows_the_empty_state(): void
    {
        $response = $this->get(route('carrito.index'));

        $response->assertOk();
        $response->assertSee('Tu carrito está vacío');
        $response->assertDontSee('cart-count');
    }

    public function test_updating_the_quantity_replaces_it_in_the_cart(): void
    {
        $product = Product::factory()->create();

        $response = $this->withSession(['carrito' => [$product->id => 1]])
            ->patch(route('carrito.update', $product), ['cantidad' => 4]);

        $response->assertRedirect(route('carrito.index'));
        $response->assertSessionHas('carrito', [$product->id => 4]);
    }

    public function test_updating_the_quantity_above_the_stock_fails_validation(): void
    {
        $product = Product::factory()->create(['stock' => 20]);

        $response = $this->withSession(['carrito' => [$product->id => 1]])
            ->patch(route('carrito.update', $product), ['cantidad' => 21]);

        $response->assertSessionHasErrors(['cantidad' => 'El campo cantidad no puede ser mayor que 20.']);
        $response->assertSessionHas('carrito', [$product->id => 1]);
    }

    public function test_removing_a_product_takes_it_out_of_the_cart(): void
    {
        $keyboard = Product::factory()->create(['name' => 'Teclado Acira']);
        $mouse = Product::factory()->create();

        $response = $this->withSession(['carrito' => [$keyboard->id => 1, $mouse->id => 2]])
            ->delete(route('carrito.destroy', $keyboard));

        $response->assertRedirect(route('carrito.index'));
        $response->assertSessionHas('carrito', [$mouse->id => 2]);
        $response->assertSessionHas('status', 'Quitaste Teclado Acira del carrito.');
    }
}
