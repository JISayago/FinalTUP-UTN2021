@extends('adminlte::page')


@section('content_header')
<div>
<h1 style="font-weight: bolder; text-align:center;">Balance:      
@if ($diferencia > 0)
<h2 style="font-weight: bolder; text-align:center;" class="text text-success">$ {{$diferencia}} </h2>   
@else
<h2 style="font-weight: bolder; text-align:center;" class="text text-danger">$ {{$diferencia}} </h2>   
@endif
</div>
@stop

@section('content')

<table class="table text-wrap table-dark table-striped">
    <thead>
        <tr >
            <th class="text-center" scope="col">Movimiento</th>
            <th class="text-center" scope="col">Fecha</th>
            <th class="text-center" scope="col">Valor</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($ingresos as $ingreso)
        <tr>
            <td class="text-center text text-success">Ingreso</td>
            <td class="text-center text text-success">${{$ingreso->fecha_pago_ingreso}}</td>
            <td class="text-center text text-success">${{$ingreso->valor_ingreso}}</td>
        </tr>      
        @endforeach         
    </tbody>

    <thead>
    </thead>
    <tbody>
        @foreach ($egresos as $egreso)
        <tr>
            <td class="text-center text text-danger">Egreso</td>
            <td class="text-center text text-danger">${{$egreso->fecha_pago_egreso}}</td>
            <td class="text-center text text-danger">- ${{$egreso->valor_egreso}}</td>
        </tr>      
        @endforeach
         
    </tbody>
</table>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="../../css/listas.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
@stop

@section('js')
@stop