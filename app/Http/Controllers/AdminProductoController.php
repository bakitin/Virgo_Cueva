<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuardarProductoRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

/**
 * CRUD de productos del panel de administración. Solo entra el usuario con is_admin.
 * Los métodos que reciben un Product usan route model binding: si el id no existe,
 * Laravel responde 404 antes de ejecutar nada.
 */
class AdminProductoController extends Controller
{
    /**
     * Carpeta del disco "public" donde se guardan las fotos subidas desde el panel.
     */
    private const IMAGE_FOLDER = 'productos';

    public function index(): View
    {
        return view('admin.productos.index', [
            'products' => Product::with(['category', 'brand'])->orderBy('id')->get(),
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
        $attributes = [...$request->productAttributes(), 'image' => $this->storeImage($request)];

        $product = DB::transaction(function () use ($attributes, $request): Product {
            $product = Product::create($attributes);
            $product->replaceSpecs($request->specValues());

            return $product;
        });

        return redirect()->route('admin.productos.index')->with('status', "Se creó el producto {$product->name}.");
    }

    public function edit(Product $product): View
    {
        $product->load('specs');

        return view('admin.productos.edit', [
            'product' => $product,
            ...$this->formOptions(),
        ]);
    }

    public function update(GuardarProductoRequest $request, Product $product): RedirectResponse
    {
        $attributes = $request->productAttributes();
        $replacedImage = null;

        if ($request->hasFile('image')) {
            $replacedImage = $product->image;
            $attributes['image'] = $this->storeImage($request);
        }

        DB::transaction(function () use ($product, $attributes, $request): void {
            $product->update($attributes);
            $product->replaceSpecs($request->specValues());
        });

        $this->deleteStoredImage($replacedImage);

        return redirect()->route('admin.productos.index')->with('status', "Se actualizó el producto {$product->name}.");
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();
        $this->deleteStoredImage($product->image);

        return redirect()->route('admin.productos.index')->with('status', "Se eliminó el producto {$product->name}.");
    }

    /**
     * Categorías y marcas para los selects del formulario.
     *
     * @return array{categories: Collection<int, Category>, brands: Collection<int, Brand>}
     */
    private function formOptions(): array
    {
        return [
            'categories' => Category::orderBy('id')->get(),
            'brands' => Brand::orderBy('name')->get(),
        ];
    }

    /**
     * Guarda la foto subida en storage/app/public/productos y devuelve su URL pública (/storage/...).
     */
    private function storeImage(GuardarProductoRequest $request): string
    {
        return '/storage/'.$request->file('image')->store(self::IMAGE_FOLDER, 'public');
    }

    /**
     * Borra una foto que se haya subido desde el panel. Las del catálogo original
     * (public/images/...) son parte del repositorio y no se tocan.
     */
    private function deleteStoredImage(?string $image): void
    {
        if ($image !== null && str_starts_with($image, '/storage/')) {
            Storage::disk('public')->delete(Str::after($image, '/storage/'));
        }
    }
}
