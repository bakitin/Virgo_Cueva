<?php

use App\Http\Controllers\AdminProductoController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OfertasController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\RegistroController;
use Illuminate\Support\Facades\Route;

Route::get('/', [InicioController::class, 'index'])->name('inicio');

Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
Route::get('/productos/{product:slug}', [ProductoController::class, 'show'])->name('productos.show');
Route::get('/ofertas', [OfertasController::class, 'index'])->name('ofertas');

Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
Route::post('/carrito/{product:slug}', [CarritoController::class, 'store'])->name('carrito.store');
Route::patch('/carrito/{product:slug}', [CarritoController::class, 'update'])->name('carrito.update');
Route::delete('/carrito/{product:slug}', [CarritoController::class, 'destroy'])->name('carrito.destroy');

Route::get('/contacto', [ContactoController::class, 'create'])->name('contacto');
Route::post('/contacto', [ContactoController::class, 'store']);

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
    Route::get('/registro', [RegistroController::class, 'create'])->name('registro');
    Route::post('/registro', [RegistroController::class, 'store']);
});

Route::post('/logout', [LoginController::class, 'destroy'])->middleware('auth')->name('logout');

// Panel de administración: hay que iniciar sesión y ser el administrador (Gate "administrar").
Route::middleware(['auth', 'can:administrar'])->prefix('admin')->name('admin.')->group(function () {
    Route::redirect('/', '/admin/productos')->name('inicio');
    Route::resource('productos', AdminProductoController::class)
        ->except('show')
        ->parameters(['productos' => 'product']);
});

// Páginas informativas: no consultan datos, así que no necesitan un controlador propio.
Route::view('/nosotros', 'nosotros')->name('nosotros');
Route::view('/garantia', 'garantia')->name('garantia');
Route::view('/cambios_devoluciones', 'cambios_devoluciones')->name('cambios_devoluciones');
Route::view('/pago_seguro', 'pago_seguro')->name('pago_seguro');
Route::view('/faq', 'faq')->name('faq');
