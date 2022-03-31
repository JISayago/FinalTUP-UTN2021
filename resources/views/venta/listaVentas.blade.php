@extends('adminlte::page')


@section('content_header')
<h1 style="font-weight: bolder">Registros de Venta <a href="/venta"><i class="bi bi-plus-circle text-success"></i></a></h1>

@stop

@section('content')
<table class="table text-wrap table-dark table-striped">
    <thead>
        <tr >
            <th class="text-center" scope="col">Cliente</th>
            <th class="text-center" scope="col">Detalle</th>
            <th class="text-center" scope="col">Fecha</th>
            <th class="text-center" scope="col">Valor</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($ingresos as $ingreso)
        <tr>
            <th class="text-center" scope="row">{{$ingreso->cliente_nombre}}</th>
            <td class="text-center">{{$ingreso->detalle_ingreso}}</td>
            <td class="text-center">{{$ingreso->fecha_pago_ingreso}}</td>
            <td class="text-center">{{$ingreso->valor_ingreso}}</td>
        </tr>      
        @endforeach
         
    </tbody>
</table>
    {{$ingresos->links('pagination::bootstrap-4')}}
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="../../css/listas.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
@stop

@section('js')
@stop