@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1 style="font-weight: bolder">Agregar Producto</h1>
@stop

@section('content')
<form action='/producto' method='POST'>
    @csrf
    <div class="formulario">
        <label for="descripcion">Descripcion</label>
        <div class="seccion">   
            <!-- En $errors tambien se puede usar 'Aerror(descipcion) border-danger Aenderror' -->         
            <input class="form-control {{$errors->has('descripcion') ? 'border-danger' : ''}}" 
            type="text" 
            name="descripcion" 
            id="descripcion"
            value="{{old('descripcion')}}">
            @if($errors->has('descripcion'))
            <p class="text-danger">{{$errors->first('descripcion')}}</p>
            @endif
        </div>
        <label for="codigo">Codigo</label>
        <div class="seccion">                    
            <input class="form-control {{$errors->has('codigo') ? 'border-danger' : ''}}"
            type="text" 
            name="codigo" 
            id="codigo"            
            value="{{old('descripcion')}}">
            @if($errors->has('codigo'))
            <p class="text-danger">{{$errors->first('codigo')}}</p>
            @endif
        </div>
        <label for="precio">Precio</label>
        <div class="seccion">
            <input class="form-control {{$errors->has('precio') ? 'border-danger' : ''}}" 
            type="text" 
            name="precio" 
            id="precio"
            value="{{old('precio')}}">
                     @if($errors->has('precio'))
            <p class="text-danger">{{$errors->first('precio')}}</p>
            @endif
        </div>
        <label for="cantidad">Cantidad</label>
        <div class="seccion">                    
            <input class="form-control {{$errors->has('cantidad') ? 'border-danger' : ''}}" 
            type="number" 
            name="cantidad" 
            id="cantidad" 
            min="0" 
            max="100"
            value="{{old('cantidad')}}">            
            @if($errors->has('cantidad'))
            <p class="text-danger">{{$errors->first('cantidad')}}</p>
            @endif
        </div>
        <label for="discontinuado">Producto Discontinuado</label>
        <div class="seccion">
            <label for="si">Si</label>            
            <input type="radio" 
            name="discontinuado" 
            id="Si" 
            value="Si">           
            <label for="no">No</label>            
            <input type="radio" 
            name="discontinuado" 
            id="No" 
            value="No">
        </div> 
        <label for="link_imagen">Link Imagen</label>
        <div class="seccion">            
            <input class="form-control {{$errors->has('link_imagen') ? 'border-danger' : ''}}" 
            type="text" 
            name="link_imagen" 
            id="link_imagen"
            value="Agregar link de referencia">            
            @if($errors->has('link_imagen'))
            <p class="text-danger">{{$errors->first('link_imagen')}}</p>
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
@stop

@section('js')
@stop