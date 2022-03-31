@extends('adminlte::page')


@section('content_header')
<h1 style="font-weight: bolder">Eliminar Cliente</h1>
@stop

@section('content')
<form action='/cliente/eliminar/{{$cliente->id}}' method='POST'>
    @csrf
    @method('Delete')
    <div class="formulario">
        <label for="descripcion">Nombre</label>
        <div class="seccion">   
            <!-- En $errors tambien se puede usar 'Aerror(descipcion) border-danger Aenderror' -->         
            <input class="form-control {{$errors->has('nombre') ? 'border-danger' : ''}}" 
            type="text" 
            name="nombre" 
            id="nombre"
            value="{{$cliente->nombre}}">           
        </div>
        <label for="saldo_favor">Saldo a favor</label>
        <div class="seccion">
            <input class="form-control {{$errors->has('saldo_favor') ? 'border-danger' : ''}}" 
            type="text" 
            name="saldo_favor" 
            id="saldo_favor"
            value="{{$cliente->saldo_favor}}">            
        </div>
        <label for="saldo_deuda">Deuda</label>
        <div class="seccion">
            <input class="form-control {{$errors->has('saldo_deuda') ? 'border-danger' : ''}}" 
            type="text" 
            name="saldo_deuda" 
            id="saldo_deuda"
            value="{{$cliente->saldo_deuda}}">           
        </div>
        <label for="realizo_pedido">Realizo Pedido</label>
        <div class="seccion">
            <label for="si">Si</label>            
            <input type="radio" 
            name="realizo_pedido" 
            id="Si" 
            value="Si"
            @if($cliente->realizo_pedido ? 'chequed' : '')@endif>                   
            <label for="no">No</label>            
            <input type="radio" 
            name="realizo_pedido" 
            id="No" 
            value="No"
            @if(!$cliente->realizo_pedido ? 'chequed' : '')@endif>   
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