<?php

use App\Http\Controllers\categoriaController;
use App\Http\Controllers\clienteController;
use App\Http\Controllers\compraController;
use App\Http\Controllers\marcasController;
use App\Http\Controllers\presentacionesController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\proveedoresController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('template');
});

Route::view('/panel', 'panel.index')->name('panel');


Route::resources([
    'categorias' => categoriaController::class,
    'presentaciones' => presentacionesController::class,
    'marcas'=> marcasController::class,
    'productos' => ProductoController::class,
    'clientes' => clienteController::class,
    'proveedores' => proveedoresController::class,
    'compras' => compraController::class
]);


Route::get('/login', function() {
    return view('auth.login');
});

Route::get('/401', function() {
    return view('pages.401');
});

Route::get('/404', function() {
    return view('pages.404');
});

Route::get('/500', function() {
    return view('pages.500');
});
