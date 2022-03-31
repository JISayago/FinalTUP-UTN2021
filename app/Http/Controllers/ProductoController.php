<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $productos = Producto::paginate(7);    
        return view('producto.listaProductos', compact('productos'));  
    }

    public function indexStock()
    {
        $productos = Producto::where('cantidad', '>', 0)->paginate(7);          
        return view('producto.listaProductos', compact('productos'));  
    }   

    public function indexSinStock()
    {
        $productos = Producto::where('cantidad', '=', 0)->paginate(7);          
        return view('producto.listaProductos', compact('productos'));  
    }

    public function show($id)
    { 
         $producto = Producto::findorfail($id);
         return view('producto/eliminarProducto',compact('producto'));     
    }

    public function create(Request $request)
    {        
        return view('producto.agregarProducto');
    }

    public function store(Request $request)
    {
        request()->validate([
        'codigo'=>'required',
        'descripcion'=>'required',
        'precio'=>'required',
        'cantidad'=>'required',
        'link_imagen => required',

        ]);
        $producto = Producto::where('codigo',$request->input('codigo'))->first();
        if($producto === null){
        $producto = new Producto(); 
        $producto->codigo = $request->input('codigo');             
        $producto->descripcion = trim($request->input('descripcion'));          
        $producto->precio =  (float)str_replace(".","",$request->input('precio'));
        $producto->cantidad = $request->input('cantidad');
        $producto->discontinuado = false;
        $producto->desde_wspp = false;
        $producto->en_carrito = false;
        $producto->en_reserva = 0; 
        $producto->en_espera = 0;      
        $producto->link_imagen = "Sin asignar";
        }
        else{
            $producto->codigo = $request->input('codigo');             
            $producto->descripcion = trim($request->input('descripcion'));
            $producto->descripcion = $request->input('cantidad');           
            $producto->precio =  (float)str_replace(".","",$request->input('precio'));
        }
        
        $producto->save();
        
        return redirect('/lista_producto');
    }
    
    public function edit($id)
    {
        $producto = Producto::findorfail($id);
        return view('producto/editarProducto',compact('producto'));
    }
 
    public function update(Request $request, $id)
    {
        request()->validate([
            'codigo'=>'required',
            'descripcion'=>'required',
            'precio'=>'required',
            'cantidad'=>'required',
            'link_imagen => required',
    
            ]);

        $producto = Producto::findorfail($id);        
        $producto->codigo = $request->input('codigo');        
        $producto->descripcion = $request->input('descripcion'); 
        $producto->precio = (float)$request->input('precio');  
        $producto->cantidad = $request->input('cantidad');   
        $producto->desde_wspp = false;
        $producto->en_carrito = false;
        $producto->en_reserva = 0;   
        $producto->en_espera = 0;
        
        if($request->input('discontinuado') == "No"){
            $producto->discontinuado = false;
        }
        else{
            $producto->discontinuado = true;
        }
        $producto->link_imagen = $request->input('link_imagen');
        $producto->save();   
        
        return redirect('/lista_producto');
       
    }
    public function destroy($id)
    {
        Producto::destroy($id); 
        return redirect('/lista_producto');      
    }
    public function stockear($p_id,$c){
        $producto= Producto::findorfail($p_id);
        if($c > $producto->en_espera){
            $producto->cantidad += $producto->en_espera;
            $producto->en_espera = 0;
        }
        else{
            $producto->cantidad += $c;
            $producto->en_espera-= $c;
        }
        $producto->save();
        return redirect()->back();
    }

    public function reorganizar_pedido($pedido_individual){

    }
    

}
