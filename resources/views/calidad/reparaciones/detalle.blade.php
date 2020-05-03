@extends('adminlte::page')

@section('content_header')
<!-- Mensaje -->
@include('calidad.reparaciones.mensaje')
<!-- Titulo de sección -->
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">
                <strong>Reparación de equipo: </strong>{{$reparacion->equipo}}
            </h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/reparaciones">Reparaciones</a></li>
            <li class="breadcrumb-item active">{{$reparacion->id}}</li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container mt-2">
    <div class="row">
        @if(Auth::user()->tipoUsuario=='calidad')
        <div class="row">
            <div class="col-md-12 col-sm-6 mb-2">
                <a href="#" class="btn btn-primary">Editar</a>
                <button 
                    type="button" 
                    class="btn btn-danger"
                    data-toggle="modal" data-target="#DeleteModal"
                    >Eliminar
                    </button>
                @include('calidad.reparaciones.deleteReparacionModal')
            </div>
        </div>
        @endif
    </div>
    <div class="card mt-2">
        <div class="card-header subform-card">
            DATOS GENERALES   
        </div>
        <div class="card-body">
        <div class="row">
            <div class="col-md-6 col-sm-12">
            <p><strong>Fecha: </strong>{{$reparacion->fecha_reparacion->format('d-m-Y')}}</p>
            <p><strong>Proveedor: </strong>{{$reparacion->proveedor}}</p>
            <p><strong>Descripcion: </strong>{{$reparacion->descripcion}}</p>
            </div>
            <div class="col-md-6 col-sm-12">
            <p><strong>Costo: </strong>{{$reparacion->costo}}</p>
            <p><strong>Verificación: </strong>{{$reparacion->verificacion}}</p>
            </div>   
        </div>
        </div>
    </div>
</div>
<div class="container mt-2">
    @include('calidad.reparaciones.crearEvento')
    <div class="card">
        <div class="card-header subform-card">
            EVENTOS      
        </div>
        <div class="card-body">
            @if(count($eventos) != 0)
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col text-center">#</th>
                        <th scope="col text-center">Fecha</th>
                        <th scope="col text-center">Descripción</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($eventos as $key=>$evento)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$evento->fecha_evento->format('d-m-yy')}}</td>
                        <td>{{$evento->descripcion}}</td>
                    </tr>           
                @endforeach
                </tbody>
            </table>
            @endif 
        </div>
    </div>
</div>

@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}"> 
@endsection

@section('js')
    <script src="{{ asset('js/custom.js') }}"></script> 
@endsection
