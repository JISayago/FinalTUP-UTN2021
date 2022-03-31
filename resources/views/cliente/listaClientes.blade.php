@extends('adminlte::page')


@section('content_header')
<h1 style="font-weight: bolder">Lista de clientes<a href="/cliente"><i class="bi bi-plus-circle text-success"></i></a></h1>

@stop

@section('content')
<table class="table text-wrap table-dark table-striped">
    <thead>
        <tr >
            <th class="text-center" scope="col">Nombre</th>
            <th class="text-center" scope="col">Deuda</th>
            <th class="text-center" scope="col">Saldo a favor</th>
            <th class="text-center" scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($clientes as $cliente)
        <tr class =  "{{($cliente->saldo_deuda > 0 ? 'text-danger' : '')}}
            {{($cliente->saldo_favor > 0 ? 'text-success' : '')}}
            ">
            <th class="text-center" scope="row">{{$cliente->nombre}}</th>
            <td class="text-center">{{$cliente->saldo_deuda}}</td>
            <td class="text-center">{{$cliente->saldo_favor}}</td>
            <td class="text-center">
                <div class="iconos_accion accion_a">
                    @if($cliente->realizo_pedido)
                    <i class="bi bi-clipboard-check text-warning"></i>
                    @else
                    <i class="bi bi-clipboard-minus text-light "></i>
                    @endif
                    <a class="btn btn-danger" href="/cliente/{{$cliente->id}}"><i class="bi bi-trash"></i></a><!--elimimar cliente-->
                    <a class="btn btn-warning" href="/cliente/editar/{{$cliente->id}}"><i class="bi bi-pencil-square "></i></a><!--editar cliente-->
                </div>
            </td>
        </tr>      
        @endforeach
         
    </tbody>
</table>
{{$clientes->links('pagination::bootstrap-4')}}
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="../../css/listas.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
@stop

@section('js')
@stop