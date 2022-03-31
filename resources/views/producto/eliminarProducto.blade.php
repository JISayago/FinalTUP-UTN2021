@extends('adminlte::page')


@section('content_header')
<h1 style="font-weight: bolder">Eliminar Producto</h1>
@stop

@section('content')
<form action='/producto/eliminar/{{$producto->id}}' method='POST'>
    @csrf
    @method('Delete')
    <div class="formulario">
        <label for="descripcion">Descripcion</label>
        <div class="seccion">   
            <!-- En $errors tambien se puede usar 'Aerror(descipcion) border-danger Aenderror' -->         
            <input class="form-control {{$errors->has('descripcion') ? 'border-danger' : ''}}" 
            type="text" 
            name="descripcion" 
            id="descripcion"            
            value="{{$producto->descripcion}}">           
        </div>
        <label for="codigo">Codigo</label>
        <div class="seccion">                    
            <input class="form-control {{$errors->has('codigo') ? 'border-danger' : ''}}"
            type="text" 
            name="codigo" 
            id="codigo"           
            value="{{$producto->codigo}}">          
        </div>
        <label for="precio">Precio</label>
        <div class="seccion">
            <input class="form-control {{$errors->has('precio') ? 'border-danger' : ''}}" 
            type="text" 
            name="precio" 
            id="precio"
            value="{{$producto->precio}}">          
        </div>
        <label for="cantidad">Cantidad</label>
        <div class="seccion">                    
            <input class="form-control {{$errors->has('cantidad') ? 'border-danger' : ''}}" 
            type="number" 
            name="cantidad" 
            id="cantidad" 
            min="0" 
            max="100"
            value="{{$producto->cantidad}}">          
        </div>
        <label for="discontinuado">Producto Discontinuado</label>
        <div class="seccion">
            <label for="si">Si</label>            
            <input type="radio" 
            name="discontinuado" 
            id="Si" 
            value="Si"
            @if($producto->discontionudao ? 'chequed' : '')@endif>
            <label for="no">No</label>            
            <input type="radio" 
            name="discontinuado" 
            id="No" 
            value="No"
            @if(!$producto->discontionudao ? 'chequed' : '')@endif>   
        </div> 
        <label for="link_imagen">Link Imagen</label>
        <div class="seccion">            
            <input class="form-control {{$errors->has('link_imagen') ? 'border-danger' : ''}}" 
            type="text" 
            name="link_imagen" 
            id="link_imagen"
            value="{{$producto->link_imagen}}">          
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