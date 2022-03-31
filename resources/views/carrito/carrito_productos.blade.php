@extends('adminlte::page')


@section('content_header')
<h1 style="font-weight: bolder">Confirmar Venta</h1>
@stop

@section('content')
<form action='' method='POST'>
    @csrf
    <input style="display:none;" type="text" name="carrito_id" id="carrito_id" value="{{$elcarrito->id}}">
    <div class="formulario">
        <div class="selector">
            <label for="cliente_id">Cliente:</label>
            <div class="seccion">                    
                <label class="form-select" 
                name="cliente_id" 
                id="cliente_id">
                {{$cliente->nombre}}                
            </label>           
        </div> 
        
    </div> 
</div>

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
        @foreach ($productos as $producto)
        <tr >
            <th class="text-center" scope="row">{{$producto->codigo}}</th>
            <td class="text-center">{{$producto->descripcion}}</td>
            <td class="text-center">{{$producto->precio}}</td>
            <td class="text-center">{{$producto->en_reserva}}</td>
            <td class="text-center">
                <div class="iconos_accion">
                    <a class="btn btn-danger btn-sm" href="/carrito/producto/eliminar/{{$elcarrito->id}}/{{$producto->id}}"><i class="bi bi-cart-x"></i></a><!--eliminar-->
                </div>
            </td>
        </tr>
        <input style="display:none;" type="text" value="{{$elcarrito->total}}">       
        @endforeach
        <div style="display: flex; justify-content:space-evenly">
            <label for="" class="text text-warning" style="float: right; font-size: 30px; ">Total a pagar: ${{$elcarrito->total}}</label>
            <a onclick="pagar();" id="a_pagar" style="float:right" class="btn btn-success btn-md" href="">Pagar  <i class="bi bi-cash-coin"></i></a><!--imagen-->
            <a onclick="cancelar();" id="cancelar" style="float:right" class="btn btn-danger btn-md" href="">Cancelar <i class="bi bi-x-circle-fill"></i></a><!--imagen-->  
    </div>
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
        window.load = function(){
        guardar_id();
    }
   
    function guardar_id(){
        var option=document.getElementById("carrito_id").value;
        return option;
    }

      function pagar(){
        var id = guardar_id();
        var link = document.getElementById('a_pagar');
        link.href = "/carrito/pagar/"+id;
    }
    
    function cancelar(){
        var id = guardar_id();
        var link = document.getElementById('cancelar');
        link.href = "/carrito/cancelar/"+id;
    }
</script>
@stop