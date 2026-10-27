<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiCatalogoController;
use App\Http\Controllers\Api\ApiProductoController;
use Illuminate\View\View;

class InicioController extends Controller
{
    public function __construct(
        private readonly ApiCatalogoController $catalogoApi,
        private readonly ApiProductoController $productoApi,
    ) {}

    public function index(): View
    {
        return view('index', [
            'categories' => $this->catalogoApi->getCategories(),
            'featuredProducts' => $this->productoApi->getFeaturedProducts(),
        ]);
    }
}
