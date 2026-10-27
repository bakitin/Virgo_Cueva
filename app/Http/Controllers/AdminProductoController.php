<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiCatalogoController;
use App\Http\Controllers\Api\ApiProductoController;
use App\Http\Requests\GuardarProductoRequest;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * CRUD de productos del panel de administración. Solo entra el usuario con is_admin.
 * Los métodos que reciben un Product usan route model binding: si el id no existe,
 * Laravel responde 404 antes de ejecutar nada.
 */
class AdminProductoController extends Controller
{
    public function __construct(
        private readonly ApiCatalogoController $catalogoApi,
        private readonly ApiProductoController $productoApi,
    ) {}

    public function index(): View
    {
        return view('admin.productos.index', [
            'products' => $this->productoApi->getAdminProducts(),
        ]);
    }

    public function create(): View
    {
        return view('admin.productos.create', [
            'product' => new Product(['is_active' => true]),
            ...$this->formOptions(),
        ]);
    }

    public function store(GuardarProductoRequest $request): RedirectResponse
    {
        $product = $this->productoApi->createProduct($request->productAttributes(), $request->specValues());

        return redirect()->route('admin.productos.index')->with('status', "Se creó el producto {$product->name}.");
    }

    public function edit(Product $product): View
    {
        $product->load('specs');

        return view('admin.productos.edit', [
            'product' => $this->productoApi->getProductDetails($product),
            ...$this->formOptions(),
        ]);
    }

    public function update(GuardarProductoRequest $request, Product $product): RedirectResponse
    {
        $product = $this->productoApi->updateProduct($product, $request->productAttributes(), $request->specValues());

        return redirect()->route('admin.productos.index')->with('status', "Se actualizó el producto {$product->name}.");
    }

    public function destroy(Product $product): RedirectResponse
    {
        $this->productoApi->deleteProduct($product);

        return redirect()->route('admin.productos.index')->with('status', "Se eliminó el producto {$product->name}.");
    }

    /**
     * Categorías y marcas para los selects del formulario.
     *
     * @return array{categories: Collection, brands: Collection}
     */
    private function formOptions(): array
    {
        return [
            'categories' => $this->catalogoApi->getCategories(),
            'brands' => $this->catalogoApi->getBrands(),
        ];
    }
}
