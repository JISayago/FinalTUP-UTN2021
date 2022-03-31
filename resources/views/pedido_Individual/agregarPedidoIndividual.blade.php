@extends('adminlte::page')


@section('content_header')
<h1 style="font-weight: bolder">Agregar Pedido</h1>
@stop

@section('content')
<form action='/pedido_individual' method='POST'>
    @csrf
    <div class="formulario">
        <div class="selector">
        <label for="cliente_id">Cliente</label>
        <div class="seccion">                    
            <select class="form-select" 
            name="cliente_id" 
            id="cliente_id">
            @foreach ($clientes as $cliente )
            <option value="{{$cliente->id}}">{{$cliente->nombre}}</option>
        @endforeach
        </select>           
        </div> 
        <label for="ciclo_id">Ciclo</label>
        <div class="seccion">                    
            <select class="form-select" 
            name="ciclo_id" 
            id="ciclo_id">
            @foreach ($ciclos as $ciclo )
                <option value="{{$ciclo->id}}">{{$ciclo->nombre}}</option>
            @endforeach
        </select>           
        </div> 
    </div>
        <label for="pedido">Pedido</label>
        <div class="seccion">                    
            <textarea class="" 
            name="pedido" 
            id="pedido"
            value="{{old('pedido')}}"></textarea>           
        </div>   
        <div class="seccion">
            <input class="form-control btn btn-info" type="submit" value="Guardar Pedido">
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