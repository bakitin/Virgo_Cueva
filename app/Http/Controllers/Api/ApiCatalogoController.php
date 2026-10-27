<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

class ApiCatalogoController extends Controller
{
    public function categories(): JsonResponse
    {
        return response()->json([
            'data' => $this->getCategories(),
        ]);
    }

    public function brands(): JsonResponse
    {
        return response()->json([
            'data' => $this->getBrands(),
        ]);
    }

    /**
     * @return Collection<int, Category>
     */
    public function getCategories(): Collection
    {
        return Category::query()->orderBy('id')->get();
    }

    /**
     * @return Collection<int, Brand>
     */
    public function getBrands(): Collection
    {
        return Brand::query()->orderBy('name')->get();
    }
}
