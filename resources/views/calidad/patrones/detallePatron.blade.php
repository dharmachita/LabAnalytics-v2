@extends('adminlte::page')

@section('content_header')
<!-- Mensaje -->
@include('calidad.patrones.mensaje')
<!-- Titulo de sección -->
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">
                <strong>PATRON: </strong>{{$patron->identificador}} - <em>{{$patron->tipo}}</em>
            </h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/patrones">Patrones</a></li>
            <li class="breadcrumb-item active">{{$patron->identificador}}</li>
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
                <a href="#" class="btn btn-danger">Eliminar</a>
            </div>
        </div>
        @endif
    </div>
    <div class="card">
        <div class="card-header subform-card">
            DATOS GENERALES   
        </div>
        <div class="card-body">
            @include('calidad.patrones.detalles.generales')
        </div>
    </div>
</div>
<div class="container mt-2">
    <div class="card">
        <div class="card-header subform-card">
            CALIBRACIONES   
        </div>
        <div class="card-body">
            @include('calidad.patrones.detalles.calibraciones')
        </div>
    </div>
</div>
<div class="container mt-2">
    <div class="card">
        <div class="card-header subform-card">
            MOVIMIENTOS   
        </div>
        <div class="card-body">
            @include('calidad.movimientos.resumen')
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
