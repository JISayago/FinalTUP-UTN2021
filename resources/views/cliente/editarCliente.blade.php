@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1 style="font-weight: bolder">Editar Cliente</h1>
@stop

@section('content')
<form action='/cliente/{{$cliente->id}}' method='POST'>
    @csrf
    @method('PUT')
    <div class="formulario">
        <label for="descripcion">Nombre</label>
        <div class="seccion">   
            <!-- En $errors tambien se puede usar 'Aerror(descipcion) border-danger Aenderror' -->         
            <input class="form-control {{$errors->has('nombre') ? 'border-danger' : ''}}" 
            type="text" 
            name="nombre" 
            id="nombre"
            value="{{$cliente->nombre}}">
            @if($errors->has('nombre'))
            <p class="text-danger">{{$errors->first('nombre')}}</p>
            @endif
        </div>
        <label for="saldo_favor">Saldo a favor</label>
        <div class="seccion">
            <input class="form-control {{$errors->has('saldo_favor') ? 'border-danger' : ''}}" 
            type="text" 
            name="saldo_favor" 
            id="saldo_favor"
            value="{{$cliente->saldo_favor}}">
                     @if($errors->has('saldo_favor'))
            <p class="text-danger">{{$errors->first('saldo_favor')}}</p>
            @endif
        </div>
        <label for="saldo_deuda">Deuda</label>
        <div class="seccion">
            <input class="form-control {{$errors->has('saldo_deuda') ? 'border-danger' : ''}}" 
            type="text" 
            name="saldo_deuda" 
            id="saldo_deuda"
            value="{{$cliente->saldo_deuda}}">
                     @if($errors->has('saldo_deuda'))
            <p class="text-danger">{{$errors->first('saldo_deuda')}}</p>
            @endif
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
            <input class="form-control btn btn-info" type="submit" value="Guardar">
        </div>
    </div>
</form>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="../../css/form.css">
@stop

@section('js')
@stop