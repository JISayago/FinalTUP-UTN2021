@extends('adminlte::page')


@section('content_header')
<h1 style="font-weight: bolder">Lista de Productos <a href="/producto"><i class="bi bi-plus-circle text-success"></i></a></h1>

@stop

@section('content')
<table class="table text-wrap table-dark table-striped">
    <thead>
        <tr >
            <th class="text-center" scope="col">Codigo</th>
            <th class="text-center" scope="col">Descripcion</th>
            <th class="text-center" scope="col">Precio</th>
            <th class="text-center" scope="col">Disponible</th>
            <th class="text-center" scope="col">Reservado</th>
            <th class="text-center" scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($productos as $producto)
        <tr class =  "{{($producto->cantidad > 0 ? 'text-success' : '')}}
            {{($producto->cantidad == 0 ? 'text-danger' : '')}}
            ">
            <input style="display:none;" type="text" name="producto_id" id="producto_id" value="{{$producto->id}}">
            <th class="text-center" scope="row">{{$producto->codigo}}</th>
            <td class="text-start">{{$producto->descripcion}}</td>
            <td class="text-center">{{$producto->precio}}</td>
            <td class="text-center">{{$producto->cantidad}}</td>
            <td class="text-center">{{$producto->en_espera}}</td>
            <td class="text-center">
                <div class="iconos_accion">
                    <a onclick="cantidad({{$producto->id}});" id="accion{{$producto->id}}" class="btn btn-success btn-sm" href=""><i class="bi bi-arrow-left-right"></i></a><!--imagen-->
                    <a class=" btn btn-info" href="{{$producto->link_imagen}} "><i class="bi bi-image"></i></a><!--imagen-->
                    <a class="btn btn-danger" href="/producto/{{$producto->id}}"><i class="bi bi-trash"></i></a><!--eliminar-->
                    <a class="btn btn-warning" href="/producto/editar/{{$producto->id}}"><i class="bi bi-pencil-square "></i></a><!--editar-->
                </div>
            </td>
        </tr>      
        @endforeach
         
    </tbody>
</table>
    {{$productos->links('pagination::bootstrap-4')}}
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="../../css/listas.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
@stop

@section('js')
<script>
    function stockear(){

    }
     function guardar_id(){
        var option=document.getElementById("producto_id").value;
        return option;
    }
    function cantidad(p_id)
    {    
        var id = guardar_id(); 
        var cantidad = prompt("Introduzca la cantidad:", "0");  
        if(cantidad === null || cantidad === " " || cantidad === ""){
            link.href = "/lista_producto";
        }
        else{
            var link = document.getElementById('accion'+p_id);
            link.href = "producto/stockear/"+p_id+"/"+cantidad;
        }     
    }
</script>
@stop