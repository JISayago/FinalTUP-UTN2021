@extends('adminlte::page')


@section('content_header')
<h1 style="font-weight: bolder">Historial Pedidos a Natura </h1>

@stop

@section('content')
<table class="table text-wrap table-dark table-striped">
    <thead>
        <tr >
            <th class="text-center" scope="col">Ciclo</th>
            <th class="text-center" scope="col">Total</th>
            <th class="text-center" scope="col"></th>            
            <th class="text-center" scope="col">Ver detalle de pedido</th>
            <th class="text-center" scope="col">Fue pagado</th>
            <th class="text-center" scope="col">Fue Recibido</th>
        </tr>
    </thead>
    <tbody>       
        <tr>
            @foreach ($pedidos_natura as $pedido_natura)
            
            <td class="text-center" scope="row">{{$pedido_natura->ciclo_nombre}}</td>
            <td class="text-center">$ {{$pedido_natura->total}}</td>
            <td class="text-center"></td>
            <td class="text-center">
                @if (!$pedido_natura->pagado && !$pedido_natura->recibido)
                    <a class=" btn btn-info" href="natura_productos/{{$pedido_natura->ciclo_id}}"><i class="bi bi-eye-fill"></i></a><!--imagen-->
                    @else
                    <a class=" btn btn-info" href="/listado_natura_productos/{{$pedido_natura->ciclo_id}}"><i class="bi bi-eye-fill"></i></a><!--imagen-->
                @endif
                
            </td>
            <td class="text-center">
                @if($pedido_natura->pagado)
                <i class="bi bi-check-circle text text-success"></i>
                @else
                <i class="bi bi-x-circle text text-danger"></i>
                @endif
                </td>            
            <td class="text-center">
                @if($pedido_natura->recibido)
                <i class="bi bi-check-circle text text-success"></i>
                @else
                <i class="bi bi-x-circle text text-danger"></i>
                @endif
            </td>
        </tr>     
         @endforeach
    </tbody>
</table>
{{$pedidos_natura->links('pagination::bootstrap-4')}}
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="../../css/listas.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
@stop

@section('js')
@stop