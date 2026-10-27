<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiCatalogoController;
use App\Http\Controllers\Api\ApiProductoController;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductoController extends Controller
{
    public function __construct(
        private readonly ApiCatalogoController $catalogoApi,
        private readonly ApiProductoController $productoApi,
    ) {}

    /**
     * Catálogo, filtrable por categoría (?categoria=slug) y por texto (?buscar=...).
     */
    public function index(Request $request): View
    {
        $categorySlug = $request->string('categoria')->toString();
        $search = $request->string('buscar')->trim()->toString();

        return view('productos', [
            'products' => $this->productoApi->getCatalog($request),
            'categories' => $this->catalogoApi->getCategories(),
            'categorySlug' => $categorySlug,
            'search' => $search,
        ]);
    }

    public function show(Product $product): View
    {
        abort_unless($product->is_active, 404);

        $product = $this->productoApi->getProductDetails($product);

        return view('producto', [
            'product' => $product,
            'relatedProducts' => $this->productoApi->getRelatedProducts($product),
        ]);
    }
}
