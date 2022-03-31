@extends('adminlte::page')


@section('content_header')
<h1 style="font-weight: bolder">Cargar Carrito</h1>
@stop

@section('content')
<form id="" action='' method='get'>
    @csrf
    <div class="formulario" style="width: 95%">
        <div class="selector">
            <label for="cliente_id">Cliente</label>
            <div class="seccion">                    
                <select class="form-select" 
                name="cliente_id" 
                id="cliente_id"
                onChange="guardar_id()">
                @if ($cliente_comprador == null)
                @foreach ($clientes as $cliente )
                <option value="{{$cliente->id}}">{{$cliente->nombre}}</option>
                @endforeach
                @else
                <option value="{{$cliente_comprador->id}}">{{$cliente_comprador->nombre}}</option>
                @endif
                
                
            </select>                   
        </div>      
        
        <div class="seleccion">
            <a onclick="carrito_cliente_id();" id="a_carrito" class="btn btn-primary btn-sm" href=""><i class="bi bi-cart-fill"></i></a><!--imagen-->
        </div>
    </div>            
    <div class="seccion">
        <table class="table text-wrap table-dark table-striped" style="width:100%">
            <thead>
                <tr>
                    <th class="text-center" scope="col">Codigo</th>
                    <th class="text-center" scope="col">Descripcion</th>
                    <th class="text-center" scope="col">Precio</th>
                    <th class="text-center" scope="col">Disponible</th>
                    <th class="text-center" scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                
                @foreach ($productos as $producto)
                <tr >
                    <th class="text-center" scope="row">{{$producto->codigo}}</th>
                    <td class="text-center">{{$producto->descripcion}}</td>
                    <td class="text-center">{{$producto->precio}}</td>
                    <td class="text-center">{{$producto->cantidad}}</td>
                    <td class="text-center">
                        <div class="iconos_accion">
                            <a onclick="cantidad({{$producto->id}});" id="accion{{$producto->id}}" class="btn btn-success btn-sm" href=""><i class="bi bi-cart-check"></i></a><!--imagen-->
                        </div>
                    </td>
                </tr> 
                @endforeach   
                
            </tbody>        
        </table>
        {{$productos->links('pagination::bootstrap-4')}}       
    </div>   
</div>

</div>
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
        var option=document.getElementById("cliente_id").value;
        return option;
    }
    function cantidad(p_id)
    {    
        var id = guardar_id(); 
        var cantidad = prompt("Introduzca la cantidad:", "0");  
        if(cantidad === null || cantidad === " " || cantidad === ""){
            link.href = "/venta";
        }
        else{
            var link = document.getElementById('accion'+p_id);
            link.href = "carrito/"+p_id+"/"+id+"/"+cantidad;
        }     
    }
    function carrito_cliente_id(){
        var id = guardar_id(); 
        var link2 = document.getElementById('a_carrito');
        link2.href = "/carrito_productos/"+id;
    }
</script>
@stop