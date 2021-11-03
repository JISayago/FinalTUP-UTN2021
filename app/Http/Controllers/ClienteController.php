<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::paginate();    
        return view('cliente.listaClientes', compact('clientes'));  
    }    
    public function show($id)
    { 
         $cliente = CLiente::findorfail($id);
         return view('cliente/eliminarcliente',compact('cliente'));     
    }

    public function create(Request $request)
    {        
        return view('cliente.agregarCliente');
    }

    public function store(Request $request)
    {
        request()->validate([
        'nombre'=>'required',
        'saldo_favor'=>'required',
        'saldo_deuda'=>'required',

        ]);
        $cliente = new Cliente(); 
        $cliente->nombre = $request->input('nombre');        
        $con_punto_favor = str_replace(",",".", $request->input('saldo_favor'));      
        $cliente->saldo_favor =  $con_punto_favor;
        $con_punto_deuda = str_replace(",",".", $request->input('saldo_deuda'));    
        $cliente->saldo_deuda =  $con_punto_deuda;
        if($request->input('realizo_pedido') == "No"){
            $cliente->realizo_pedido = false;
        }
        else{
            $cliente->realizo_pedido = true;
        }       
        $cliente->save();   
        
        return redirect('/lista_cliente');
    }
    
    public function edit($id)
    {
        $cliente = Cliente::findorfail($id);
        return view('cliente/editarCliente',compact('cliente'));
    }
 
    public function update(Request $request, $id)
    {
        request()->validate([
            'nombre'=>'required',
            'saldo_favor'=>'required',
            'saldo_deuda'=>'required',    
            ]);

        $cliente = Cliente::findorfail($id);   
        $cliente->nombre = $request->input('nombre');        
        $con_punto_favor = str_replace(",",".", $request->input('saldo_favor'));      
        $cliente->saldo_favor =  $con_punto_favor;
        $con_punto_deuda = str_replace(",",".", $request->input('saldo_deuda'));    
        $cliente->saldo_deuda =  $con_punto_deuda;
        if($request->input('realizo_pedido') == "No"){
            $cliente->realizo_pedido = false;
        }
        else{
            $cliente->realizo_pedido = true;
        }       
        $cliente->save();   
        
        return redirect('/lista_cliente');
       
    }
    public function destroy($id)
    {
        Cliente::destroy($id); 
        return redirect('/lista_cliente');      
    }
}
