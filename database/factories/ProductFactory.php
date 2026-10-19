<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->words(3, true);

        return [
            'category_id' => Category::factory(),
            'brand_id' => Brand::factory(),
            'name' => Str::ucfirst($name),
            'slug' => Str::slug($name),
            'image' => '/images/teclados/ACIRA_1.webp',
            'price' => fake()->numberBetween(100, 3000) * 1000,
            'old_price' => null,
            'short_description' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'badge' => null,
            'featured' => false,
            'stock' => 20,
            'is_active' => true,
        ];
    }

    /**
     * Producto que aparece en "Lo más pedido" de la portada.
     */
    public function featured(): static
    {
        return $this->state(fn (array $attributes) => [
            'featured' => true,
        ]);
    }

    /**
     * Producto rebajado: su precio anterior es mayor al actual.
     */
    public function onSale(): static
    {
        return $this->state(fn (array $attributes) => [
            'old_price' => $attributes['price'] + 50000,
        ]);
    }

    /**
     * Producto oculto de la tienda.
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }
}
