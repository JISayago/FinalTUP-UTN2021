<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarritoProductosController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function store($id,$cliente,$cantidad){//id = productoid,cliente = cliente id, cantidad es cantidad de producto comprado
        
        $carrito = new Carrito();
        $carrito->cliente_id = $cliente;
        $carrito->cantidad = $cantidad;        
        $carrito->save();
        
        
        $carrito_producto = new CarritoProductos();
        $carrito_producto->carrito_id = $carrito->id;
        $carrito_producto->producto_id = $id;
        $carrito_producto->save();     
        
        $clientes = Cliente::all();   
        $ciclos = Ciclo::all();
        $productos = Producto::where('cantidad', '>', 0)->paginate(7);
        
        return redirect()->back();
        
    }
}
