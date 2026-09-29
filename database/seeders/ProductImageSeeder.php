<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;

class ProductImageSeeder extends Seeder
{
    public function run(): void
    {
        $product = Product::where('slug', 'acira')->first();

        ProductImage::create([
            'product_id' => $product->id,
            'image' => '/images/teclados/ACIRA_1.webp',
            'sort_order' => 1,
            'is_primary' => true,
        ]);

        ProductImage::create([
            'product_id' => $product->id,
            'image' => '/images/teclados/ACIRA_2.webp',
            'sort_order' => 2,
            'is_primary' => false,
        ]);

        ProductImage::create([
            'product_id' => $product->id,
            'image' => '/images/teclados/ACIRA_3.webp',
            'sort_order' => 3,
            'is_primary' => false,
        ]);
    }
}