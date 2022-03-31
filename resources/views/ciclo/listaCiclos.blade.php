@extends('adminlte::page')


@section('content_header')
<h1 style="font-weight: bolder">Lista de Ciclos <a href="/ciclo"><i class="bi bi-plus-circle text-success"></i></a></h1>

@stop

@section('content')
<table class="table text-wrap table-dark table-striped">
    <thead>
        <tr >
            <th class="text-center" scope="col">Nombre del Ciclo</th>
            <th class="text-center" scope="col">Fecha de Inicio</th>
            <th class="text-center" scope="col">Fecha de Finalización</th>
            <th class="text-center" scope="col">Acciones</th>
           
        </tr>
    </thead>
    <tbody>
        @foreach ($ciclos as $ciclo)
        <tr >
            <th class="text-center" scope="row">{{$ciclo->nombre}}</th>
            <td class="text-center">{{$ciclo->fecha_inicio}}</td>
            <td class="text-center">{{$ciclo->fecha_finalizacion}}</td>            
            <td class="text-center">
                <div class="iconos_accion">
                    @foreach ($pedidos_natura as $pedido_natura)                   
                    @if($pedido_natura->ciclo_id == $ciclo->id)
                        @if(!$pedido_natura->recibido || !$pedido_natura->pagado)
                        <a class="btn btn-info" href="/natura_productos/{{$ciclo->id}}"><i class="bi bi-clipboard-data"></i></a><!--imagen-->
                        @else
                        <a class="btn btn-info" href="/listado_natura_productos/{{$ciclo->id}}"><i class="bi bi-clipboard-data"></i></a><!--imagen-->
                        @endif
                    
                    @endif
                    @endforeach
                    <a class="btn btn-danger" href="/ciclo/{{$ciclo->id}}"><i class="bi bi-trash"></i></a><!--eliminar-->
                    <a class="btn btn-warning" href="/ciclo/editar/{{$ciclo->id}}"><i class="bi bi-pencil-square "></i></a><!--editar-->
                </div>
            </td>
        </tr>      
        @endforeach
         
    </tbody>
</table>
{{$ciclos->links('pagination::bootstrap-4')}}
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="../../css/listas.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
@stop

@section('js')
<script>

  console.log("122 unidad(es) - Código: 108820 -  Precio: $ 3.865,00  Regalo Una Blush 1 unidad(es) - Código: 108797 -  Precio: $ 2.760,00  Regalo Biografía Clásico femenino 1 unidad(es) - Código: 108794 -  Precio: $ 2.715,00  Regalo Humor meu primeiro ritual".split(' '));
  
</script>
@stop