@extends('adminlte::page')


@section('content_header')
<h1 style="font-weight: bolder">Pedido Natura para el ciclo: {{$pedido_natura->ciclo_nombre}}</h1>
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
            <td class="text-center">{{$producto->en_espera}}</td>
            <td class="text-center">
                <div class="iconos_accion">
                    <a class="btn btn-danger" href="/natura_productos/producto/eliminar/{{$producto->id}}/{{$pedido_natura->id}}"><i class="bi bi-trash"></i></a><!--eliminar-->
                </div>
            </td>
        </tr>      
        @endforeach
              
        <div style="display: flex; justify-content:space-evenly">
            <label for="" class="text text-warning" style="float: right; font-size: 30px; ">Total a pagar: ${{$pedido_natura->total}}</label>
            @if ($pedido_natura->pagado)
            <a style="float:right" class="btn btn-danger btn-md" href="">Pagado  <i class="bi bi-cash-coin"></i></a><!--imagen--> 
            @else 
            <a onclick="pagar();" id="a_pagar" style="float:right" class="btn btn-success btn-md" href="">Pagar  <i class="bi bi-cash-coin"></i></a><!--imagen--> 
            @endif
            @if ($pedido_natura->recibido)
            <a style="float:right" class="btn btn-warning btn-md" href="">En Stock  <i class="bi bi-bag-check"></i></a><!--imagen--> 
            @else 
            <a onclick="recibir();" id="a_recibir" style="float:right" class="btn btn-primary btn-md" href="">Recibido  <i class="bi bi-box-arrow-in-down"></i></a><!--imagen--> 
            @endif              
    </div>
    </tbody>    
</table>
{{$productos->links('pagination::bootstrap-4')}}
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
        var option=document.getElementById("pedido_natura_id").value;
        return option;
    }
      function pagar(){
        var id = guardar_id();
        var link = document.getElementById('a_pagar');
        link.href = "/natura_productos/productos/pagar/"+id;
    }
    function recibir(){
        var id = guardar_id();
        var link = document.getElementById('a_recibir');
        link.href = "/natura_productos/productos/recibir/"+id;
    }
</script>
@stop