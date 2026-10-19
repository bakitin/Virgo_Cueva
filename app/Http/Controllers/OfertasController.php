<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Carbon\WeekDay;
use Illuminate\View\View;

class OfertasController extends Controller
{
    /**
     * Productos rebajados y el tiempo que queda de las "ofertas de la semana", que terminan el domingo.
     */
    public function index(): View
    {
        $secondsLeft = (int) now()->diffInSeconds(now()->endOfWeek(WeekDay::Sunday));

        return view('ofertas', [
            'products' => Product::active()->onSale()->with('brand')->orderBy('id')->get(),
            'countdown' => [
                'days' => intdiv($secondsLeft, 86400),
                'hours' => intdiv($secondsLeft % 86400, 3600),
                'minutes' => intdiv($secondsLeft % 3600, 60),
            ],
        ]);
    }
}
