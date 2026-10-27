<?php

use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\ApiCatalogoController;
use App\Http\Controllers\Api\ApiProductoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [ApiAuthController::class, 'login'])
    ->name('api.login');

Route::get('/productos', [ApiProductoController::class, 'index'])->name('api.productos.index');
Route::get('/productos/{product:slug}', [ApiProductoController::class, 'show'])->name('api.productos.show');
Route::middleware(['auth:sanctum', 'can:administrar'])->group(function () {
    Route::get('/admin/productos', [ApiProductoController::class, 'adminIndex'])->name('api.admin.productos.index');
    Route::post('/admin/productos', [ApiProductoController::class, 'store'])->name('api.admin.productos.store');
    Route::put('/admin/productos/{product}', [ApiProductoController::class, 'update'])->name('api.admin.productos.update');
    Route::patch('/admin/productos/{product}', [ApiProductoController::class, 'update']);
    Route::delete('/admin/productos/{product}', [ApiProductoController::class, 'destroy'])->name('api.admin.productos.destroy');
});
Route::middleware('auth:sanctum')->post('/logout', [ApiAuthController::class, 'logout'])->name('api.logout');
Route::get('/categorias', [ApiCatalogoController::class, 'categories'])->name('api.categorias.index');
Route::get('/marcas', [ApiCatalogoController::class, 'brands'])->name('api.marcas.index');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
