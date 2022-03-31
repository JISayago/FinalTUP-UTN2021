<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrito;
use App\Models\Producto;
use App\Models\Ciclo;
use App\Models\Cliente;
use App\Models\CarritoProductos;
use App\Models\Ingreso;
use App\Models\PedidoIndividual;
use App\Models\PedidoIndividualProducto;
use app\Http\Controllers\ProductoController;
use app\Http\Controllers\CicloController;
use app\Http\Controllers\ClienteController;

class CarritoController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function store_producto_carrito($p_id,$c_id,$cantidad){        
        
        $producto = Producto::findorfail($p_id);
        $producto->en_carrito = true;    
        if($cantidad > $producto->cantidad){
            $cantidad = $producto->cantidad; 
        }
        $producto->cantidad -= $cantidad;
        $producto->en_reserva = $cantidad;
        $producto->save();
        
        $cliente_comprador = Cliente::findorfail($c_id);
        $cliente_comprador->comprando = true;  
        $cliente_comprador->save();      
        return redirect('venta');
        
    }
    
    public function store($cliente){
        // para crear un solo carrito
        $carrito = new Carrito();
        $carrito->cliente_id = $cliente;
        $carrito->cantidad = 0;
        $carrito->total=0;      
        $carrito->pagado = false;        
        $carrito->save();
        
        $productos = Producto::where('en_carrito',true)->get();       
        
        foreach($productos as $producto){
            
            //para crear los id de 1 carrito con los respectivos productos
            $carrito_producto = new CarritoProductos();
            $carrito_producto->carrito_id = $carrito->id;
            $carrito_producto->producto_id = $producto->id;
            $carrito_producto->save();             
        }
        
        return redirect("/carrito/productos/".$cliente);
    }
    
    public function store_productos_pedido($cliente){
        
        $carrito = new Carrito();
        $carrito->cliente_id = $cliente;
        $carrito->cantidad = 0;
        $carrito->total=0;      
        $carrito->pagado = false;        
        $carrito->save();
        
        $cliente_comprador = Cliente::findorfail($cliente);
        $cliente_comprador->comprando = true;  
        $cliente_comprador->save();      
        $pedido = $cliente_comprador->pedido_individual;
        
        $pedido_individual = PedidoIndividual::find($pedido->id);
        
        $pedido_productos = PedidoIndividualProducto::where('pedido_individual_id',$pedido_individual->id)->get();
        
        foreach($pedido_productos as $producto){
            //para crear los id de 1 carrito con los respectivos productos
            $carrito_producto = new CarritoProductos();
            $carrito_producto->carrito_id = $carrito->id;
            $carrito_producto->producto_id = $producto->producto_id;
            $carrito_producto->save();
            
            $prod = Producto::findorfail($producto->id);
            $prod->en_carrito = true;        
            $prod->save();
        }
        
        return redirect("/carrito/productos/".$cliente);
    }
    
    public function lista_productos_en_carrito($id){
        
        $cliente = Cliente::findorfail($id); 
        
        $carritos = Carrito::all();
        foreach($carritos as $carrito){
            if($carrito->cliente_id == $cliente->id)
            {
                $elcarrito = $carrito;
            }
        }           
        
        $productos = Producto::where('en_carrito',true)->get();
        foreach($productos as $producto){
            if($producto->en_reserva > 1){
                $elcarrito->total += ($producto->en_reserva*$producto->precio);
            }
            else{
                $elcarrito->total += ($producto->precio);
            }
        }
        
        
        $elcarrito->save();
        
        return view('carrito/carrito_productos',compact('elcarrito','cliente','productos'));     
    }
    
    public function remove_producto_carrito($carr_id,$p_id){
        
        $producto = Producto::findorfail($p_id);
        $producto->en_carrito = false;        
        $producto->cantidad += $producto->en_reserva;
        $producto->en_reserva = 0;
        $producto->save();
        
        $carrito = Carrito::findorfail($carr_id);
        
        $cliente = $carrito->cliente->id;
        $carrito_productos = CarritoProductos::where('carrito_id', '=' ,$carr_id)->get(); 
        foreach($carrito_productos as $linea){
            if($linea->producto_id == $p_id){
                $carrito->total -= $linea->precio;
                $carrito->save();
                CarritoProductos::destroy($linea->id); 
            }
        }
        return redirect("/carrito/productos/".$cliente);
    }   
    public function pagar_producto_carrito($carr_id){
        
        $carrito_productos = CarritoProductos::where('carrito_id', '=', $carr_id)->get(); 
        foreach($carrito_productos as $linea){
            $producto = Producto::findorfail($linea->producto_id);
            $producto->en_carrito = false;        
            $producto->en_reserva = 0;
            $producto->save();
        }
        
        $now =now();
        
        $carrito = Carrito::findorfail($carr_id);
        $cliente = Cliente::findorfail($carrito->cliente_id);
        $cliente->comprando = false;
        $cliente->realizo_pedido = false;
        $cliente->save();
        $ingreso = new Ingreso();
        $ingreso->valor_ingreso = $carrito->total;
        $ingreso->fecha_pago_ingreso = $now;
        $ingreso->detalle_ingreso = "Ingreso por Venta";
        $ingreso->cliente_id = $carrito->cliente_id;
        $ingreso->cliente_nombre = $cliente->nombre;
        $ingreso->save();
        
        return redirect('/venta');
        
    }
    
    public function cancelar_producto_carrito($carr_id){
        
        $carrito_productos = CarritoProductos::where('carrito_id', '=', $carr_id)->get(); 
        foreach($carrito_productos as $linea){
            $producto = Producto::findorfail($linea->producto_id);
            $producto->en_carrito = false;
            $producto->cantidad += $producto->en_reserva;        
            $producto->en_reserva = 0;
            $producto->save();
        }
        
        $carrito = Carrito::findorfail($carr_id);
        $cliente = Cliente::findorfail($carrito->cliente_id);
        $cliente->comprando = false;
        $cliente->save();
        
        return redirect('/venta');
    }
    
}




