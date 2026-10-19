<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class InicioController extends Controller
{
    public function index(): View
    {
        return view('index', [
            'categories' => Category::orderBy('id')->get(),
            'featuredProducts' => Product::active()->featured()->with('brand')->orderBy('id')->get(),
        ]);
    }
}
