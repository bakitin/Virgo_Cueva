<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductSpec;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ProductSpec>
 */
class ProductSpecFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'name' => 'Especificación',
            'value' => fake()->sentence(3),
            'sort_order' => 1,
        ];
    }
}
