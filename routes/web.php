<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PedidoIndividualController;
use App\Http\Controllers\PedidoNaturaController;
use App\Http\Controllers\CicloController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\CarritoProductosController;
use App\Http\Controllers\BalanceController;

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
    return view('auth.login');
});
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::middleware(['auth:sanctum', 'verified'])->get('/lista_cliente', function () {
    return view('cliente.listaClientes');
});

//Ventas
Route::get('/venta', [VentaController::class, 'create']);
Route::get('/lista_ventas/', [VentaController::class, 'lista_ventas']);

//Pedido Natura
Route::get('/natura_productos/{ciclo_id}',[PedidoNaturaController::class, 'show_pedido_natura'])->name('natura_productos');
Route::get('/natura_productos/productos/pagar/{pedido_natura_id}',[PedidoNaturaController::class, 'pagar_pedido_natura']);
Route::get('/natura_productos/productos/recibir/{pedido_natura_id}',[PedidoNaturaController::class, 'recibir_pedido_natura']);
Route::get('/natura_productos/producto/eliminar/{producto_id}/{pedido_natura_id}',[PedidoNaturaController::class, 'quitar_producto_pedido']);
Route::get('/listado_pedido_natura',[PedidoNaturaController::class, 'listado_pedidos_natura']);
Route::get('/listado_natura_productos/{ciclo_id}',[PedidoNaturaController::class, 'listado_productos_pedido_natura']);

//Producto
Route::get('/lista_producto',[ProductoController::class, 'index']);
Route::get('/lista_producto_stock',[ProductoController::class, 'indexStock']);
Route::get('/lista_producto_sin',[ProductoController::class, 'indexSinStock']);
Route::get('/producto', [ProductoController::class, 'create']);
Route::post('/producto', [ProductoController::class, 'store']);
Route::get('/producto/{id}', [ProductoController::class, 'show']);
Route::delete('/producto/eliminar/{id}', [ProductoController::class, 'destroy']);
Route::get('/producto/editar/{id}', [ProductoController::class, 'edit']);
Route::put('/producto/{id}', [ProductoController::class, 'update']);
Route::get('/producto/stockear/{p_id}/{can}', [ProductoController::class,'stockear']);


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
Route::get('/pedido_individual', [PedidoIndividualController::class, 'create']);
Route::post('/pedido_individual', [PedidoIndividualController::class, 'store_PedidoWspp']);
Route::get('/pedido_individual/{id}', [PedidoIndividualController::class, 'show']);
Route::delete('/pedido_individual/eliminar/{id}', [PedidoIndividualController::class, 'destroy']);
Route::get('/pedido_individual/editar/{id}', [PedidoIndividualController::class, 'edit']);
Route::put('/pedido_individual/{id}', [PedidoIndividualController::class, 'update']);
Route::get('/pedido_individual_productos/{id}', [PedidoIndividualController::class, 'show_pedidos_productos']);

//Ciclos
Route::get('/lista_ciclo',[CicloController::class, 'index']);
Route::get('/ciclo', [CicloController::class, 'create']);
Route::post('/ciclo', [CicloController::class, 'store']);
Route::get('/ciclo/{id}', [CicloController::class, 'show']);
Route::delete('/ciclo/eliminar/{id}', [CicloController::class, 'destroy']);
Route::get('/ciclo/editar/{id}', [CicloController::class, 'edit']);
Route::put('/ciclo/{id}', [CicloController::class, 'update']);

//CargaCarrito
Route::get('/carrito/{p_id}/{c_id}/{cantidad}', [CarritoController::class, 'store_producto_carrito']);
Route::get('/carrito_productos/{id}', [CarritoController::class, 'store']);
Route::get('/pedido_productos_carrito/{id}', [CarritoController::class, 'store_productos_pedido']);

//Carrito
Route::get('/carrito/productos/{id}', [CarritoController::class, 'lista_productos_en_carrito']);

//DescargaCarrito
Route::get('/carrito/pagar/{carr_id}', [CarritoController::class, 'pagar_producto_carrito']);
Route::get('/carrito/cancelar/{carr_id}', [CarritoController::class, 'cancelar_producto_carrito']);
Route::get('/carrito/producto/eliminar/{carr_id}/{p_id}', [CarritoController::class, 'remove_producto_carrito']);

//balance
Route::get('/balance', [BalanceController::class, 'index']);
Route::post('/balance', [BalanceController::class, 'comparar']);