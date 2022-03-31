@extends('adminlte::page')


@section('content_header')
<h1 style="font-weight: bolder">Seleccionar Periodo</h1>
@stop

@section('content')
<form action='/balance' method='POST'>
    @csrf
    <div class="formulario">
        
        <label for="nombre">Fecha de Inicio</label>
        <div class="seccion">   
            <!-- En $errors tambien se puede usar 'Aerror(descipcion) border-danger Aenderror' -->         
            <input class="form-control" 
            type="date" 
            name="fecha_inicio" 
            id="fecha_inicio"
            value="">
        </div>
        <label for="nombre">Fecha de Finalización</label>
        <div class="seccion">   
            <!-- En $errors tambien se puede usar 'Aerror(descipcion) border-danger Aenderror' -->         
            <input class="form-control " 
            type="date" 
            name="fecha_finalizacion" 
            id="fecha_finalizacion"
            value="">
        </div>
        
        <div class="seccion">
            <input class="form-control btn btn-info" type="submit" value="Comparar periodo">
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