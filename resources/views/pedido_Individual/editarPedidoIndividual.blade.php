@extends('adminlte::page')


@section('content_header')
<h1 style="font-weight: bolder">Editar Pedido Individual</h1>
@stop

@section('content')
<form action='/pedido_individual/{{$pedido_individual->id}}' method='POST'>
    @csrf
    @method('PUT')
    <div class="formulario">
        <div class="selector">
        <label for="cliente_id">Cliente:</label>
        <div class="seccion">                    
            <label>{{$pedido_individual->cliente->nombre}}</label>
        </div> 
        <label for="ciclo_id">Ciclo: </label>
        <div class="seccion">                    
                <label for="">{{$pedido_individual->ciclo->nombre}}</label>           
        </div> 
    </div>
        <label for="pedido">Agregar productos al pedido  <a class=" btn btn-info btn-sm" href="/pedido_individual_productos/{{$pedido_individual->id}}"><i class="bi bi-eye-fill"></i></a><!--imagen--></label>
        <div class="seccion">                    
            <textarea class="" 
            name="pedido" 
            id="pedido"           
            value="">       
            </textarea>           
        </div>   
        <div class="seccion">
            <input class="form-control btn btn-info" type="submit" value="Guardar">
        </div>
    </div>
</form>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="../../css/form.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
@stop

@section('js')
@stop