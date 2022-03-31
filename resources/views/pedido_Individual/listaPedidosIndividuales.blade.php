@extends('adminlte::page')


@section('content_header')
<h1 style="font-weight: bolder">Lista de Pedidos <a href="/pedido_individual"><i class="bi bi-plus-circle text-success"></i></a></h1>

@stop

@section('content')
<table class="table text-wrap table-dark table-striped">
    <thead>
        <tr >
            <th class="text-center" scope="col">Cliente</th>
            <th class="text-center" scope="col">Ciclo</th>
            <th class="text-center" scope="col">Total</th>
            <th class="text-center" scope="col">Ver Pedido</th>
        </tr>
    </thead>
    <tbody>       
        <tr>
            @foreach ($pedidos_individuales as $pedido_individual)
            <th class="text-center" scope="row">{{$pedido_individual->cliente_nombre}}</th>
            <td class="text-center">{{$pedido_individual->ciclo_nombre}}</td>
            <td class="text-center">{{$pedido_individual->total_pagar}}</td>
            <td class="text-center">
                <div class="">
                    <a class=" btn btn-info" href="/pedido_individual_productos/{{$pedido_individual->id}}"><i class="bi bi-eye-fill"></i></a><!--imagen-->
                </div>
            </td>
        </tr>     
         @endforeach
    </tbody>
</table>
{{$pedidos_individuales->links('pagination::bootstrap-4')}}
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="../../css/listas.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
@stop

@section('js')
@stop