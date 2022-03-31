@extends('adminlte::page')


@section('content_header')
<h1 style="font-weight: bolder">Editar Ciclo</h1>
@stop

@section('content')
<form action='/ciclo/{{$ciclo->id}}' method='POST'>
    @csrf
    @method('PUT')
    <div class="formulario">
        <label for="nombre">Nombre</label>
        <div class="seccion">   
            <!-- En $errors tambien se puede usar 'Aerror(descipcion) border-danger Aenderror' -->         
            <input class="form-control {{$errors->has('nombre') ? 'border-danger' : ''}}" 
            type="text" 
            name="nombre" 
            id="nombre"            
            value="{{$ciclo->nombre}}">
            @if($errors->has('nombre'))
            <p class="text-danger">{{$errors->first('nombre')}}</p>
            @endif
        </div>
        <label for="nombre">Fecha de Inicio</label>
        <div class="seccion">   
            <!-- En $errors tambien se puede usar 'Aerror(descipcion) border-danger Aenderror' -->         
            <input class="form-control {{$errors->has('fecha_inicio') ? 'border-danger' : ''}}" 
            type="date" 
            name="fecha_inicio" 
            id="fecha_inicio"
            value="{{$ciclo->fecha_inicio}}">
            @if($errors->has('fecha_inicio'))
            <p class="text-danger">{{$errors->first('fecha_inicio')}}</p>
            @endif
        </div>
        <label for="nombre">Fecha de Finalización</label>
        <div class="seccion">   
            <!-- En $errors tambien se puede usar 'Aerror(descipcion) border-danger Aenderror' -->         
            <input class="form-control {{$errors->has('fecha_finalizacion') ? 'border-danger' : ''}}" 
            type="date" 
            name="fecha_finalizacion" 
            id="fecha_finalizacion"
            value="{{$ciclo->fecha_finalizacion}}">
            @if($errors->has('fecha_finalizacion'))
            <p class="text-danger">{{$errors->first('fecha_finalizacion')}}</p>
            @endif
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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
@stop

@section('js')
@stop