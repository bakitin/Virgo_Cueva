<?php

use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\OfertasController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\NosotrosController;
use App\Http\Controllers\AyudaController;
use App\Http\Controllers\ContactoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NuevouController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\GarantiaController;
use App\Http\Controllers\Cambios_devolucionesController;
use App\Http\Controllers\Pago_seguroController;
use App\Http\Controllers\FaqController;




Route::get('/', [InicioController::class, 'index']);
Route::get('/productos', [ProductosController::class, 'productos']);
Route::get('/producto', [ProductoController::class, 'producto']);
Route::get('/categorias', [CategoriasController::class, 'categorias']);
Route::get('/usuarios', [UsuariosController::class, 'usuarios']);
Route::get('/carrito', [CarritoController::class, 'carrito']);
Route::get('/ofertas', [OfertasController::class, 'ofertas']);
Route::get('/nuevou', [NuevouController::class, 'nuevou']);
Route::get('/nosotros', [NosotrosController::class, 'nosotros']);
Route::get('/ayuda', [AyudaController::class, 'ayuda']);
Route::get('/contacto', [ContactoController::class, 'contacto']);
Route::get('/login', [LoginController::class, 'login']);
Route::get('/garantia', [GarantiaController::class, 'garantia']);
Route::get('/cambios_devoluciones', [Cambios_devolucionesController::class, 'Cambios_devoluciones']);
Route::get('/pago_seguro', [Pago_seguroController::class, 'pago_seguro']);
Route::get('/faq', [FaqController::class, 'faq']);