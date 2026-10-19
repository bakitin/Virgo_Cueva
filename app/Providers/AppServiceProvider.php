<?php

namespace App\Providers;

use App\Http\Controllers\CarritoController;
use Illuminate\Support\Facades;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

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
        Facades\View::composer('layouts.app', function (View $view): void {
            $view->with('cartCount', array_sum(session(CarritoController::SESSION_KEY, [])));
        });
    }
}
