@extends('adminlte::page')


@section('content_header')
<h1 style="font-weight: bolder" >Pedido Natura para el ciclo: {{$pedido_natura->ciclo_nombre}}</h1>
<h2 style="font-weight: bolder" class="text text-danger">Total gastado: {{$pedido_natura->total}}</h2>
@stop

@section('content')
<form action='' method='POST'>
    @csrf
    @method('PUT')
    <input style="display:none;" type="text" name="pedido_natura_id" id="pedido_natura_id" value="{{$pedido_natura->id}}">
   

<table class="table text-wrap table-dark table-striped">
    <thead>
        <tr >
            <th class="text-center" scope="col">Codigo</th>
            <th class="text-center" scope="col">Descripcion</th>
            <th class="text-center" scope="col">Precio</th>
            <th class="text-center" scope="col">Cantidad Ingresada</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($natura_productos_ciclo as $producto)
        <tr >
            <th class="text-center" scope="row">{{$producto->codigo_producto}}</th>
            <td class="text-center">{{$producto->descripcion_producto}}</td>
            <td class="text-center">{{$producto->precio_producto}}</td>
            <td class="text-center">{{$producto->cantidad_ingresada_producto}}</td>
            <td class="text-center">
            </td>
        </tr>      
        @endforeach
              
        
    </tbody>    
</table>
{{$natura_productos_ciclo->links('pagination::bootstrap-4')}}
</form>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="../../css/form.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
@stop

@section('js')

@stop