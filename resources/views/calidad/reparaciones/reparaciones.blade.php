@extends('adminlte::page')

@section('content_header')
<!-- Mensaje -->
@include('calidad.reparaciones.mensaje')
<!-- Titulo de sección -->
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">
                Listado de Reparaciones de Equipos
            </h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active">Reparaciones</li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container mt-2">
   <!-- Tabla Reparaciones -->
   @include('calidad.reparaciones.tabla') 
</div> 
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}"> 
@endsection

@section('js')
    <script src="{{ asset('js/custom.js') }}"></script> 
@endsection
