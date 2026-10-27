<?php

namespace Tests\Feature\Api;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class ApiProductoControllerTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_index_returns_active_products_and_filters_hidden_products(): void
    {
        $visibleProduct = Product::factory()->create(['name' => 'Producto visible']);
        Product::factory()->inactive()->create(['name' => 'Producto oculto']);

        $response = $this->getJson(route('api.productos.index'));

        $response->assertOk()
            ->assertJsonPath('data.0.id', $visibleProduct->id)
            ->assertJsonMissing(['name' => 'Producto oculto']);
    }

    public function test_show_returns_not_found_for_an_inactive_product(): void
    {
        $product = Product::factory()->inactive()->create();

        $response = $this->getJson(route('api.productos.show', $product));

        $response->assertNotFound();
    }

    public function test_admin_products_endpoint_requires_authentication(): void
    {
        $response = $this->getJson(route('api.admin.productos.index'));

        $response->assertUnauthorized();
    }

    public function test_admin_can_get_a_bearer_token_from_the_api_login(): void
    {
        $admin = User::factory()->admin()->create([
            'email' => 'admin@example.com',
            'password' => 'password',
        ]);

        $response = $this->postJson(route('api.login'), [
            'email' => 'admin@example.com',
            'password' => 'password',
        ]);

        $response->assertOk()
            ->assertJsonStructure(['token', 'user' => ['id', 'email']]);
        $this->assertDatabaseCount('personal_access_tokens', 1);
        $this->assertNotEmpty($response->json('token'));
        $this->assertSame($admin->id, $response->json('user.id'));

        $adminProductsResponse = $this->withToken($response->json('token'))
            ->getJson(route('api.admin.productos.index'));

        $adminProductsResponse->assertOk();
    }

    public function test_api_login_rejects_invalid_credentials(): void
    {
        User::factory()->create(['email' => 'admin@example.com']);

        $response = $this->postJson(route('api.login'), [
            'email' => 'admin@example.com',
            'password' => 'wrong-password',
        ]);

        $response->assertStatus(422)
            ->assertJson(['message' => 'El correo o la contraseña no son correctos.']);
        $this->assertDatabaseCount('personal_access_tokens', 0);
    }

    public function test_admin_can_create_a_product_through_the_api(): void
    {
        $admin = User::factory()->admin()->create();
        $category = Category::factory()->create();
        $brand = Brand::factory()->create();

        $response = $this->actingAs($admin, 'sanctum')->postJson(route('api.admin.productos.store'), [
            'category_id' => $category->id,
            'brand_id' => $brand->id,
            'name' => 'Producto API',
            'slug' => 'producto-api',
            'price' => 100000,
            'stock' => 4,
            'specs' => "USB\nRGB",
            'image' => '/images/teclados/ACIRA_1.webp',
        ]);

        $response->assertCreated()
            ->assertJsonPath('data.name', 'Producto API');
        $this->assertDatabaseHas('products', ['slug' => 'producto-api']);
    }

    public function test_admin_can_delete_a_product_through_the_api(): void
    {
        $admin = User::factory()->admin()->create();
        $product = Product::factory()->create();

        $response = $this->actingAs($admin, 'sanctum')
            ->deleteJson(route('api.admin.productos.destroy', $product));

        $response->assertNoContent();
        $this->assertModelMissing($product);
    }
}
