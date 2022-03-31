<?php

namespace App\Http\Controllers;

use App\Models\Ciclo;
use App\Models\PedidoNatura;
use Illuminate\Http\Request;

class CicloController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index()
    {
        $ciclos = Ciclo::paginate(7);
        $pedidos_natura = PedidoNatura::all();
        return view('ciclo.listaCiclos', compact('ciclos','pedidos_natura'));  
    }    
    public function show($id)
    { 
         $ciclo = Ciclo::findorfail($id);
         return view('ciclo/eliminarCiclo',compact('ciclo'));     
    }

    public function create(Request $request)
    {        
        return view('ciclo.agregarCiclo');
    }

    public function store(Request $request)
    {
        request()->validate([
        'nombre'=>'required',
        'fecha_inicio'=>'required',
        'fecha_finalizacion'=>'required',

        ]);
        $ciclo = new Ciclo(); 
        $ciclo->nombre = $request->input('nombre');
        $ciclo->fecha_inicio = $request->input('fecha_inicio');        
        $ciclo->fecha_finalizacion = $request->input('fecha_finalizacion');                
        
        $ciclo->save();   
        
        return redirect('/lista_ciclo');
    }
    
    public function edit($id)
    {
        $ciclo = Ciclo::findorfail($id);
        return view('ciclo/editarCiclo',compact('ciclo'));
    }
 
    public function update(Request $request, $id)
    {
        request()->validate([
            'nombre'=>'required',
            'fecha_inicio'=>'required',
            'fecha_finalizacion'=>'required', 
            ]);

        $ciclo = Ciclo::findorfail($id);   
        $ciclo->nombre = $request->input('nombre');
        $ciclo->fecha_inicio = $request->input('fecha_inicio');        
        $ciclo->fecha_finalizacion = $request->input('fecha_finalizacion');                
        
        $ciclo->save();   
        
        return redirect('/lista_ciclo');
       
    }
    public function destroy($id)
    {
        Ciclo::destroy($id); 
        return redirect('/lista_ciclo');      
    }
}
