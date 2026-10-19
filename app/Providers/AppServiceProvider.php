<?php

namespace App\Providers;

use App\Http\Controllers\CarritoController;
use App\Models\User;
use Illuminate\Support\Facades;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
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
        Route::resourceVerbs([
            'create' => 'crear',
            'edit' => 'editar',
        ]);

        Gate::define('administrar', fn (User $user): bool => $user->is_admin === true);

        Facades\View::composer('layouts.app', function (View $view): void {
            $view->with('cartCount', array_sum(session(CarritoController::SESSION_KEY, [])));
        });
    }
}
