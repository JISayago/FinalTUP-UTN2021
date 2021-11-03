<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PedidoIndividualController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.register');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/panel', function () {
    return view('panel.index');
})->name('panel');

//Producto
Route::get('/lista_producto',[ProductoController::class, 'index']);
Route::get('/producto', [ProductoController::class, 'create']);
Route::post('/producto', [ProductoController::class, 'store']);
Route::get('/producto/{id}', [ProductoController::class, 'show']);
Route::delete('/producto/eliminar/{id}', [ProductoController::class, 'destroy']);
Route::get('/producto/editar/{id}', [ProductoController::class, 'edit']);
Route::put('/producto/{id}', [ProductoController::class, 'update']);


//Cliente
Route::get('/lista_cliente',[ClienteController::class, 'index']);
Route::get('/cliente', [ClienteController::class, 'create']);
Route::post('/cliente', [ClienteController::class, 'store']);
Route::get('/cliente/{id}', [ClienteController::class, 'show']);
Route::delete('/cliente/eliminar/{id}', [ClienteController::class, 'destroy']);
Route::get('/cliente/editar/{id}', [ClienteController::class, 'edit']);
Route::put('/cliente/{id}', [ClienteController::class, 'update']);

//Pedidos Individuales
Route::get('/lista_pedidos',[PedidoIndividualController::class, 'index']);