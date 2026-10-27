<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GuardarProductoRequest;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiProductoController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        return response()->json([
            'data' => $this->getCatalog($request),
        ]);
    }

    public function adminIndex(): JsonResponse
    {
        return response()->json([
            'data' => $this->getAdminProducts(),
        ]);
    }

    public function store(GuardarProductoRequest $request): JsonResponse
    {
        $product = $this->createProduct($request->productAttributes(), $request->specValues());

        return response()->json([
            'data' => $this->getProductDetails($product),
        ], 201);
    }

    public function update(GuardarProductoRequest $request, Product $product): JsonResponse
    {
        $product = $this->updateProduct($product, $request->productAttributes(), $request->specValues());

        return response()->json([
            'data' => $this->getProductDetails($product),
        ]);
    }

    public function destroy(Product $product): JsonResponse
    {
        $this->deleteProduct($product);

        return response()->json(status: 204);
    }

    public function show(Product $product): JsonResponse
    {
        abort_unless($product->is_active, 404);

        return response()->json([
            'data' => $this->getProductDetails($product),
        ]);
    }

    /**
     * @return Collection<int, Product>
     */
    public function getAdminProducts(): Collection
    {
        return Product::query()
            ->with(['category', 'brand'])
            ->orderBy('id')
            ->get();
    }

    /**
     * @param  array<string, mixed>  $attributes
     * @param  list<string>  $specValues
     */
    public function createProduct(array $attributes, array $specValues): Product
    {
        return DB::transaction(function () use ($attributes, $specValues): Product {
            $product = Product::create($attributes);
            $product->replaceSpecs($specValues);

            return $product;
        });
    }

    /**
     * @param  array<string, mixed>  $attributes
     * @param  list<string>  $specValues
     */
    public function updateProduct(Product $product, array $attributes, array $specValues): Product
    {
        DB::transaction(function () use ($product, $attributes, $specValues): void {
            $product->update($attributes);
            $product->replaceSpecs($specValues);
        });

        return $product->fresh();
    }

    public function deleteProduct(Product $product): void
    {
        $product->delete();
    }

    /**
     * @return Collection<int, Product>
     */
    public function getCatalog(Request $request): Collection
    {
        $categorySlug = $request->string('categoria')->toString();
        $search = $request->string('buscar')->trim()->toString();

        return Product::active()
            ->with('brand')
            ->when($categorySlug !== '', fn (Builder $query) => $query->whereRelation('category', 'slug', $categorySlug))
            ->when($search !== '', fn (Builder $query) => $query->where(fn (Builder $query) => $query
                ->where('name', 'like', "%{$search}%")
                ->orWhere('short_description', 'like', "%{$search}%")
                ->orWhereRelation('brand', 'name', 'like', "%{$search}%")))
            ->orderBy('id')
            ->get();
    }

    /**
     * @return Collection<int, Product>
     */
    public function getFeaturedProducts(): Collection
    {
        return Product::active()
            ->featured()
            ->with('brand')
            ->orderBy('id')
            ->get();
    }

    /**
     * @return Collection<int, Product>
     */
    public function getProductsOnSale(): Collection
    {
        return Product::active()
            ->onSale()
            ->with('brand')
            ->orderBy('id')
            ->get();
    }

    /**
     * @param  array<int, int|string>  $productIds
     * @return Collection<int, Product>
     */
    public function getCartProducts(array $productIds): Collection
    {
        return Product::active()
            ->with('brand')
            ->whereKey($productIds)
            ->orderBy('id')
            ->get();
    }

    public function getProductDetails(Product $product): Product
    {
        $product->load(['category', 'brand', 'specs']);

        return $product;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getRelatedProducts(Product $product): Collection
    {
        return Product::active()
            ->whereBelongsTo($product->category)
            ->whereKeyNot($product->getKey())
            ->with('brand')
            ->orderBy('id')
            ->limit(4)
            ->get();
    }
}
