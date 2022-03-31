@extends('adminlte::page')


@section('content_header')
<h1 style="font-weight: bolder">Detalles de Pedido Individual</h1>
@stop

@section('content')
<form action='/pedido_individual/{{$pedido_individual->id}}' method='POST'>
    @csrf
    @method('PUT')
    <div class="formulario">
        <div class="selector">
            <label for="cliente_id">Cliente</label>
            <div class="seccion">                    
                <select class="form-select" 
                name="cliente_id" 
                id="cliente_id">
                <option value="{{$pedido_individual->cliente->id}}">{{$pedido_individual->cliente->nombre}}</option>
            </select>           
        </div> 
        <label for="ciclo_id">Ciclo</label>
        <div class="seccion">                    
            <select class="form-select" 
            name="ciclo_id" 
            id="ciclo_id">
            <option value="{{$pedido_individual->ciclo->id}}">{{$pedido_individual->ciclo->nombre}}</option>
        </select>           
    </div> 
</div>
<div class="seleccion">
    <a onclick="carrito_cliente_id();" id="a_carrito" style="float:right" class="btn btn-primary btn-sm" href=""><i class="bi bi-cart-fill"></i></a><!--imagen-->
</div>
<label for="pedido">Pedido</label>
<table class="table text-wrap table-dark table-striped">
    <thead>
        <tr >
            <th class="text-center" scope="col">Codigo</th>
            <th class="text-center" scope="col">Descripcion</th>
            <th class="text-center" scope="col">Precio</th>
            <th class="text-center" scope="col">Cantidad</th>
            <th class="text-center" scope="col">Quitar del Pedido</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pedido_productos as $producto)
        <tr >
            <th class="text-center" scope="row">{{$producto->codigo_producto}}</th>
            <td class="text-start">{{$producto->descripcion_producto}}</td>
            <td class="text-center">{{$producto->precio_producto}}</td>
            <td class="text-center">{{$producto->cantidad_pedida_producto}}</td>
            <td class="text-center">
                <div class="iconos_accion">
                    <a class="btn btn-danger" href="/producto/{{$producto->id}}"><i class="bi bi-trash"></i></a><!--eliminar-->
                </div>
            </td>
        </tr>      
        @endforeach
        
    </tbody>    
</table>
</form>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="../../css/form.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
@stop

@section('js')
<script>
    function guardar_id(){
        var option=document.getElementById("cliente_id").value;
        return option;
    }
 function carrito_cliente_id(){
        var id = guardar_id(); 
        var link2 = document.getElementById('a_carrito');
        link2.href = "/pedido_productos_carrito/"+id;
    }

</script>
@stop