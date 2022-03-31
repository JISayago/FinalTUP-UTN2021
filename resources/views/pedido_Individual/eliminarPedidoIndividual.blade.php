@extends('adminlte::page')


@section('content_header')
<h1 style="font-weight: bolder">Eliminar Pedido Individual</h1>
@stop

@section('content')
<form action='/pedido_individual/eliminar/{{$pedido_individual->id}}' method='POST'>
    @csrf
    @method('Delete')
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
        <label for="pedido">Pedido</label>
        <div class="seccion">                    
            <textarea class="" 
            name="pedido" 
            id="pedido"           
            value="">       
            </textarea>           
        </div>   
        <div class="seccion">
            <input class="form-control btn btn-danger" type="submit" value="Eliminar">
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
@stop