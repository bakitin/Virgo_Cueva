<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductoController extends Controller
{
    /**
     * Catálogo, filtrable por categoría (?categoria=slug) y por texto (?buscar=...).
     */
    public function index(Request $request): View
    {
        $categorySlug = $request->string('categoria')->toString();
        $search = $request->string('buscar')->trim()->toString();

        $products = Product::active()
            ->with('brand')
            ->when($categorySlug !== '', fn (Builder $query) => $query->whereRelation('category', 'slug', $categorySlug))
            ->when($search !== '', fn (Builder $query) => $query->where(fn (Builder $query) => $query
                ->where('name', 'like', "%{$search}%")
                ->orWhere('short_description', 'like', "%{$search}%")
                ->orWhereRelation('brand', 'name', 'like', "%{$search}%")))
            ->orderBy('id')
            ->get();

        return view('productos', [
            'products' => $products,
            'categories' => Category::orderBy('id')->get(),
            'categorySlug' => $categorySlug,
            'search' => $search,
        ]);
    }

    public function show(Product $product): View
    {
        abort_unless($product->is_active, 404);

        $product->load(['category', 'brand', 'specs']);

        $relatedProducts = Product::active()
            ->whereBelongsTo($product->category)
            ->whereKeyNot($product->getKey())
            ->with('brand')
            ->orderBy('id')
            ->limit(4)
            ->get();

        return view('producto', [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
        ]);
    }
}
