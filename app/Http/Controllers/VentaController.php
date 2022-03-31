<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use app\Http\Controllers\ProductoController;
use App\Models\Cliente;
use app\Http\Controllers\ClienteController;
use App\Models\Ciclo;
use App\Models\Ingreso;
use App\Models\PedidoIndividualProducto;
use app\Http\Controllers\CicloController;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function create()
    {        
        $clientes = Cliente::where('nombre','!=',"Natura")->get();
        $cliente_comprador = Cliente::where('comprando',true)->first();
        $ciclos = Ciclo::all();
        $productos = Producto::where('cantidad', '>', 0)->paginate(7); 
        return view('venta.agregarVenta', compact('clientes','ciclos','productos','cliente_comprador'));
    }

    public function lista_ventas()
    {
        $ingresos = Ingreso::where('valor_ingreso', '>', 0)->paginate(7); 
        
        return view('venta.listaVentas',compact('ingresos'));
    }
    
}
