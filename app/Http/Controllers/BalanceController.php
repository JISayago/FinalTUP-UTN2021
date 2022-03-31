<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingreso;
use App\Models\Egreso;

class BalanceController extends Controller
{
    public function index(){
        return view('balance.elegirFechas');
    }
    public function comparar(Request $request){
     
     $inicio = $request->input('fecha_inicio');
     $fin = $request->input('fecha_finalizacion');

     $ingresos = Ingreso::whereBetween('fecha_pago_ingreso', [$inicio, $fin])->get();
     $egresos = Egreso::whereBetween('fecha_pago_egreso', [$inicio, $fin])->get();
     
     $total_ingresos = 0;
     $total_egresos = 0;

     foreach($ingresos as $ingreso){
        $total_ingresos += $ingreso->valor_ingreso;
     }

     foreach($egresos as $egreso){
        $total_egresos += $egreso->valor_egreso;
     }

      $diferencia = $total_ingresos-$total_egresos;
     
    return view('balance.balance',compact('ingresos','egresos','diferencia'));

    }
}
