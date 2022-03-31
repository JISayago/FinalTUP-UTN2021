<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Egreso;
use App\Models\Ciclo;
use App\Models\PedidoNatura;
use App\Models\NaturaProductosCiclo;
class PedidoNaturaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function show_pedido_natura($ciclo_id){
        $productos = Producto::where('desde_wspp',true)->paginate(7);
        $ciclo = Ciclo::findorfail($ciclo_id);
        $pedido_natura = PedidoNatura::where('ciclo_id',$ciclo_id)->firstorfail();
        
        return view('pedido_natura.listaProductosPedidoNatura',compact('productos','ciclo','pedido_natura')); 
    }
    
    public function quitar_producto_pedido($producto_id,$pedido_natura_id){
        // tengo q descontar del total
        
        $producto = Producto::findorfail($producto_id);
        
        $pedido_natura = PedidoNatura::findorfail($pedido_natura_id);
        if($producto->en_reserva > 1){
            $pedido_natura->total  -= ($producto->en_espera*$producto->precio);
        }
        else{
            $pedido_natura->total -= ($producto->precio);
        }           
        $pedido_natura->save();
        if($producto->cantidad == 0 && $producto->en_espera > 0 && $producto->desde_wspp==true){
            Producto::destroy($producto_id); 
        }
        
        return redirect()->back();      
        
    }
    
    public function pagar_pedido_natura($pedido_natura_id){
        
        $pedido_natura = PedidoNatura::findorfail($pedido_natura_id); 
        $pedido_natura->pagado = true;
        $pedido_natura->save();
        
        $now =now();
        
        $egreso = new Egreso();
        $egreso->valor_egreso = $pedido_natura->total;
        $egreso->fecha_pago_egreso = $now;
        $egreso->detalle_egreso = "Pago por pedido a Natura del ciclo: ".$pedido_natura->ciclo_nombre;
        $egreso->cliente_id = 1;
        $egreso->save();
        
        return redirect('/lista_ciclo');
        
    }
    
    public function recibir_pedido_natura($pedido_natura_id){
        
        $pedido_natura = PedidoNatura::findorfail($pedido_natura_id); 
        $pedido_natura->recibido = true;
        $pedido_natura->save();
        
        $productos = Producto::where('desde_wspp',true)->get();
        foreach($productos as $producto){
            $productos_pedido_natura = new NaturaProductosCiclo();
            $productos_pedido_natura->pedido_natura_id = $pedido_natura->id;
            $productos_pedido_natura->producto_id = $producto->id;
            $productos_pedido_natura->codigo_producto = $producto->codigo;
            $productos_pedido_natura->descripcion_producto = $producto->descripcion;
            $productos_pedido_natura->precio_producto = $producto->precio;
            $productos_pedido_natura->cantidad_ingresada_producto = $producto->en_espera;
            $productos_pedido_natura->save();
            
            $producto_cantidad = Producto::findorfail($producto->id);
            $producto_cantidad->desde_wspp = false;
            //$producto_cantidad->cantidad += $producto_cantidad->en_espera;
            //$producto_cantidad->en_espera = 0;
            $producto_cantidad->save(); 
        }
        
        return redirect('/lista_producto_stock');
        
    }
    
    public function listado_pedidos_natura(){
        $pedidos_natura = PedidoNatura::paginate(7);
        return view ('pedido_natura.listaPedidosNatura', compact('pedidos_natura'));
    }
    
    
    public function listado_productos_pedido_natura($ciclo_id){
        $pedido_natura = PedidoNatura::where('ciclo_id',$ciclo_id)->first();
        $natura_productos_ciclo = NaturaProductosCiclo::where('pedido_natura_id',$pedido_natura->id)->paginate(7);

        return view ('pedido_natura.listaProductosPedidoNaturaStockeado', compact('natura_productos_ciclo','pedido_natura'));
    }
}
