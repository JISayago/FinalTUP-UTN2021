<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{

    public function index()
    {
        $productos = Producto::paginate();    
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
        $producto = new Producto(); 
        $producto->codigo = $request->input('codigo');        
        $producto->descripcion = $request->input('descripcion'); 
        $con_punto = str_replace(",",".", $request->input('precio'));    
        $producto->precio =  $con_punto;
        $producto->cantidad = $request->input('cantidad');        
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
        $con_punto = str_replace(",",".", $request->input('precio'));    
        $producto->precio =  $con_punto;
        $producto->cantidad = $request->input('cantidad');        
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

}
