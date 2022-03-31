<?php

namespace App\Http\Controllers;

use App\Models\PedidoIndividual;
use App\Models\Producto;
use app\Http\Controllers\ProductoController;
use App\Models\Cliente;
use app\Http\Controllers\ClienteController;
use App\Models\Ciclo;
use App\Models\PedidoIndividualProducto;
use App\Models\PedidoNatura;
use App\Models\PedidoNaturaIndividuales;
use app\Http\Controllers\CicloController;
use Illuminate\Http\Request;

class PedidoIndividualController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index()
    {
        $pedidos_individuales = PedidoIndividual::paginate(7);
        
        return view('pedido_individual.listaPedidosIndividuales',compact('pedidos_individuales'));
    }  
    
    public function show($id)
    { 
        $pedido_individual = PedidoIndividual::findorfail($id);
        $productos = $pedido_individual->productos;
        return view('pedido_individual/eliminarPedidoIndividual',compact('pedido_individual','productos'));     
    }
    
    public function show_pedidos_productos($id){
        $pedido_individual = PedidoIndividual::findorfail($id);
        $pedido_productos = PedidoIndividualProducto::where('pedido_individual_id',$pedido_individual->id)->get();
        return view('pedido_individual/listaProductosPedidoIndividuales',compact('pedido_individual','pedido_productos')); 
    }
    
    public function create(Request $request)
    {    
        $clientes = Cliente::where('nombre','!=',"Natura")->get();    
        $ciclos = Ciclo::all();     
        return view('pedido_individual.agregarPedidoIndividual', compact('clientes','ciclos'));
    }
    
    public function store_PedidoWspp(Request $request){
        
        $productos = explode("*",$request->input('pedido'));
        
        $pedido_individual = new PedidoIndividual();            
        $pedido_individual->cliente_id = $request->input('cliente_id');
        $pedido_individual->cliente_nombre = Cliente::findorfail($pedido_individual->cliente_id)->nombre;
        $pedido_individual->ciclo_id = $request->input('ciclo_id');
        $pedido_individual->ciclo_nombre = Ciclo::findorfail($pedido_individual->ciclo_id)->nombre;        
        $pedido_individual->total_pagar =  0;
        $pedido_individual->cantidad = 0;
        $pedido_individual->save();
        $cliente = Cliente::find($pedido_individual->cliente_id);
        $cliente->realizo_pedido = true;
        $cliente->save();  
        
        foreach($productos as $producto){
            list($unidades, $codigo, $preciodescripcion) = explode("-", $producto);        
            list($unidad) = explode(" ",$unidades);
            /*echo $unidad . "</br>"; */        
            list($espacio,$texto,$elCodigo) = explode(" ",$codigo);       
            /*echo $elCodigo. "</br>";*/ 
            $parte1 = str_split($preciodescripcion,10);
            $cod = $parte1[1];    
            list($descarte, $cadena) = explode("$ ",$preciodescripcion);
            list($elPrecio, $cadena2) = explode(" ",$cadena);
            /*echo $elPrecio. "</br>";*/
            list($descarte, $laDescripcion) = explode("0 ",$preciodescripcion);           
            /*echo $laDescripcion. "</br>";*/

            $producto = Producto::where('codigo',$elCodigo)->first();
            if($producto === null){
            $producto = new Producto(); 
            $producto->codigo = $elCodigo;                 
            $producto->descripcion = trim($laDescripcion);          
            $producto->precio =  (float)str_replace(".","",$elPrecio);
            $producto->cantidad = 0;
            $producto->discontinuado = false;
            $producto->desde_wspp = true;
            $producto->en_carrito = false;
            $producto->en_reserva = 0; 
            $producto->en_espera = $unidad;      
            $producto->link_imagen = "Sin asignar";
            }
            else{
                $producto->codigo = $elCodigo;                 
                $producto->descripcion = trim($laDescripcion);          
                $producto->precio =  (float)str_replace(".","",$elPrecio);
                $producto->en_espera += $unidad;      
                $producto->link_imagen = "Sin asignar";
            }
            
            $producto->save();
            
            $pedido_individual_producto = new PedidoIndividualProducto();
            $pedido_individual_producto->pedido_individual_id = $pedido_individual->id;
            $pedido_individual_producto->producto_id = $producto->id;
            $pedido_individual_producto->codigo_producto = $producto->codigo;
            $pedido_individual_producto->descripcion_producto = $producto->descripcion;
            $pedido_individual_producto->precio_producto = $producto->precio;
            $pedido_individual_producto->cantidad_pedida_producto = $producto->en_espera;
            $pedido_individual_producto->save();           
            
            $pedido = PedidoIndividual::findorfail($pedido_individual_producto->pedido_individual_id);
            $pedido->total_pagar += $producto->precio;
            $pedido->cantidad += 1;
            $pedido->save();
        }
        $this->agregar_a_pedido_natura($pedido_individual->ciclo_id);
        
        $p_natura = PedidoNatura::where('ciclo_id',$pedido_individual->ciclo_id)->firstOrFail();
        
        
        $pedido_natura_individuales = new PedidoNaturaIndividuales();
        $pedido_natura_individuales->pedido_natura_id = $p_natura->id;
        $pedido_natura_individuales->pedido_individual_id = $pedido_individual->id;
        $pedido_natura_individuales->save(); 
        
        return redirect()->route('natura_productos',['ciclo_id' =>$pedido_individual->ciclo_id]); 
    }
    
    public function agregar_a_pedido_natura($ciclo_id){
        $pedido_cerrado = PedidoNatura::first('ciclo_id',$ciclo_id);
        if($pedido_cerrado->pagado || $pedido_cerrado->recibido){
            
        }
        else{
            $productos = Producto::where('desde_wspp',true)->get();
            $total = 0;
            foreach($productos as $producto){
                if($producto->en_reserva > 1){
                    $total  += ($producto->en_reserva*$producto->precio);
                }
                else{
                    $total += ($producto->precio);
                }           
            }
            
            $pedido_natura = PedidoNatura::firstOrNew(
                ['ciclo_id' => $ciclo_id],
                [
                    'ciclo_nombre' =>Ciclo::findorfail($ciclo_id)->nombre,
                    'total' =>0,
                    'pagado' => false,
                    'recibido' => false,               
                ]);
                
                $pedido_natura->save();       
            
             $pedido_naturatot = PedidoNatura::findorfail($pedido_natura->id);
             $pedido_naturatot->total +=$total;
             $pedido_naturatot->save();
        }
        
        }

        public function edit($id)
        {
            $pedido_individual = PedidoIndividual::findorfail($id);
            $productos = $pedido_individual->productos;
            return view('pedido_individual/editarPedidoIndividual',compact('pedido_individual','productos'));
        }
        
        public function destroy($id)
        {
            PedidoIndividual::destroy($id); 
            return redirect('/pedido_individual');      
        }
        
    }
    