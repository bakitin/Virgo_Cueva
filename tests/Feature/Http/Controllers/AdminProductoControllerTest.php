<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductSpec;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class AdminProductoControllerTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_guest_is_sent_to_the_login_page(): void
    {
        $response = $this->get(route('admin.productos.index'));

        $response->assertRedirect(route('login'));
    }

    public function test_customer_cannot_open_the_panel(): void
    {
        $response = $this->actingAs(User::factory()->create())->get(route('admin.productos.index'));

        $response->assertForbidden();
    }

    public function test_customer_cannot_delete_products(): void
    {
        $product = Product::factory()->create();

        $response = $this->actingAs(User::factory()->create())->delete(route('admin.productos.destroy', $product));

        $response->assertForbidden();
        $this->assertModelExists($product);
    }

    public function test_admin_sees_every_product_including_hidden_ones(): void
    {
        Product::factory()->create(['name' => 'Teclado visible']);
        Product::factory()->inactive()->create(['name' => 'Teclado escondido']);

        $response = $this->actingAs(User::factory()->admin()->create())->get(route('admin.productos.index'));

        $response->assertOk();
        $response->assertSee('Teclado visible');
        $response->assertSee('Teclado escondido');
        $response->assertSee('<span class="tag tag--off">Oculto</span>', false);
    }

    public function test_admin_creates_a_product_with_image_path_and_specs(): void
    {
        $response = $this->actingAs(User::factory()->admin()->create())->post(route('admin.productos.store'), $this->validPayload([
            'name' => 'Razer Viper V3 Pro',
            'price' => 599900,
            'specs' => "Sensor de 35.000 DPI\n\n   54 gramos   ",
            'image' => '/images/teclados/ACIRA_1.webp',
        ]));

        $response->assertRedirect(route('admin.productos.index'));
        $response->assertSessionHas('status', 'Se creó el producto Razer Viper V3 Pro.');
        $product = Product::where('slug', 'razer-viper-v3-pro')->sole();
        $this->assertSame(599900, $product->price);
        $this->assertNull($product->old_price);
        $this->assertTrue($product->is_active);
        $this->assertFalse($product->featured);
        $this->assertSame(['Sensor de 35.000 DPI', '54 gramos'], $product->specs->pluck('value')->all());
        $this->assertSame('/images/teclados/ACIRA_1.webp', $product->image);
    }

    public function test_a_photo_is_required_to_create_a_product(): void
    {
        $response = $this->actingAs(User::factory()->admin()->create())->post(route('admin.productos.store'), $this->validPayload(['image' => '']));

        $response->assertSessionHasErrors(['image' => 'El campo foto es obligatorio.']);
        $this->assertDatabaseCount('products', 0);
    }

    public function test_the_category_must_exist(): void
    {
        $response = $this->actingAs(User::factory()->admin()->create())->post(route('admin.productos.store'), $this->validPayload([
            'category_id' => 999,
        ]));

        $response->assertSessionHasErrors(['category_id' => 'La categoría seleccionada no existe.']);
        $this->assertDatabaseCount('products', 0);
    }

    public function test_two_products_cannot_share_the_same_slug(): void
    {
        Product::factory()->create(['slug' => 'logitech-g305']);

        $response = $this->actingAs(User::factory()->admin()->create())->post(route('admin.productos.store'), $this->validPayload([
            'name' => 'Logitech G305',
        ]));

        $response->assertSessionHasErrors(['slug' => 'Ese slug ya está registrado.']);
        $this->assertDatabaseCount('products', 1);
    }

    public function test_the_old_price_must_be_higher_than_the_price(): void
    {
        $product = Product::factory()->create(['price' => 100000]);

        $response = $this->actingAs(User::factory()->admin()->create())
            ->put(route('admin.productos.update', $product), $this->validPayload(['price' => 100000, 'old_price' => 90000]));

        $response->assertSessionHasErrors(['old_price' => 'El precio anterior debe ser mayor que el precio actual (si no está en oferta, déjalo vacío).']);
        $this->assertNull($product->fresh()->old_price);
    }

    public function test_admin_updates_a_product_and_replaces_its_specs(): void
    {
        $product = Product::factory()->featured()->create(['image' => '/images/teclados/ACIRA_1.webp']);
        ProductSpec::factory()->for($product)->create(['value' => 'Spec vieja']);

        $response = $this->actingAs(User::factory()->admin()->create())->put(route('admin.productos.update', $product), $this->validPayload([
            'name' => 'Teclado Acira Pro',
            'slug' => 'acira-pro',
            'price' => 210000,
            'old_price' => 250000,
            'stock' => 3,
            'specs' => "Switches rojos\nRGB",
        ]));

        $response->assertRedirect(route('admin.productos.index'));
        $response->assertSessionHas('status', 'Se actualizó el producto Teclado Acira Pro.');
        $product->refresh();
        $this->assertSame('Teclado Acira Pro', $product->name);
        $this->assertSame('acira-pro', $product->slug);
        $this->assertSame(210000, $product->price);
        $this->assertSame(250000, $product->old_price);
        $this->assertSame(3, $product->stock);
        $this->assertFalse($product->featured);
        $this->assertSame('/images/teclados/ACIRA_1.webp', $product->image);
        $this->assertSame(['Switches rojos', 'RGB'], $product->specs->pluck('value')->all());
    }

    public function test_a_product_keeps_its_own_slug_when_edited(): void
    {
        $product = Product::factory()->create(['name' => 'Logitech G305', 'slug' => 'logitech-g305']);

        $response = $this->actingAs(User::factory()->admin()->create())
            ->put(route('admin.productos.update', $product), $this->validPayload(['name' => 'Logitech G305', 'slug' => 'logitech-g305']));

        $response->assertSessionHasNoErrors();
        $this->assertSame('logitech-g305', $product->fresh()->slug);
    }

    public function test_updating_a_product_replaces_its_image_path(): void
    {
        $product = Product::factory()->create(['image' => '/images/teclados/ACIRA_1.webp']);

        $this->actingAs(User::factory()->admin()->create())->put(route('admin.productos.update', $product), $this->validPayload([
            'image' => '/images/mouses/RAZER_VIPER_V3_PRO.webp',
        ]));

        $this->assertSame('/images/mouses/RAZER_VIPER_V3_PRO.webp', $product->fresh()->image);
    }

    public function test_admin_deletes_a_product_with_its_specs_without_deleting_image_files(): void
    {
        $product = Product::factory()->create(['name' => 'Silla Iskur', 'image' => '/images/teclados/ACIRA_1.webp']);
        $spec = ProductSpec::factory()->for($product)->create();

        $response = $this->actingAs(User::factory()->admin()->create())->delete(route('admin.productos.destroy', $product));

        $response->assertRedirect(route('admin.productos.index'));
        $response->assertSessionHas('status', 'Se eliminó el producto Silla Iskur.');
        $this->assertModelMissing($product);
        $this->assertModelMissing($spec);
    }

    /**
     * @return array<string, array{string, string}>
     */
    public static function actionsOnAMissingProduct(): array
    {
        return [
            'editar' => ['get', 'admin.productos.edit'],
            'actualizar' => ['put', 'admin.productos.update'],
            'eliminar' => ['delete', 'admin.productos.destroy'],
        ];
    }

    #[DataProvider('actionsOnAMissingProduct')]
    public function test_acting_on_a_product_that_does_not_exist_returns_404(string $method, string $routeName): void
    {
        $admin = User::factory()->admin()->create();

        $response = $this->actingAs($admin)->{$method}(route($routeName, 999));

        $response->assertNotFound();
    }

    /**
     * Datos válidos del formulario; cada test cambia solo lo que necesita.
     *
     * @param  array<string, mixed>  $overrides
     * @return array<string, mixed>
     */
    private function validPayload(array $overrides = []): array
    {
        return [
            'category_id' => Category::factory()->create()->id,
            'brand_id' => Brand::factory()->create()->id,
            'name' => 'Logitech G305',
            'slug' => '',
            'price' => 150000,
            'old_price' => '',
            'stock' => 5,
            'badge' => '',
            'short_description' => 'Inalámbrico y liviano.',
            'description' => 'Un clásico confiable.',
            'specs' => '',
            'is_active' => '1',
            'image' => '/images/teclados/ACIRA_1.webp',
            ...$overrides,
        ];
    }
}
