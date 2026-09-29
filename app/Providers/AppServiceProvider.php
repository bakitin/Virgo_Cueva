<?php

namespace App\Providers;

use App\Models\Product;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.app', function ($view) {
            $products = Product::with(['category', 'brand', 'specs'])
                ->where('is_active', true)
                ->get()
                ->map(fn (Product $product) => [
                    'id' => $product->slug,
                    'category' => $product->category->slug,
                    'brand' => $product->brand->name,
                    'name' => $product->name,
                    'image' => $product->image,
                    'price' => (float) $product->price,
                    'oldPrice' => $product->old_price ? (float) $product->old_price : null,
                    'badge' => $product->badge,
                    'featured' => $product->featured,
                    'shortDesc' => $product->short_description,
                    'description' => $product->description,
                    'specs' => $product->specs->sortBy('sort_order')->pluck('value')->values(),
                ]);

            $view->with('productsJson', $products);
        });
    }
}
