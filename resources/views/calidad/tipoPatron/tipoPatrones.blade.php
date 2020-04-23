@extends('adminlte::page')

@section('content')
<div class="container">
    <!-- Mensaje -->
    @include('calidad.tipoPatron.mensaje')
    <!-- Titulo de sección -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">
                    Tipos de Patrones de Calibración
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Tipo de Patron</li>
                </ol>
            </div>
            </div>
        </div>
    </div>
    <!-- Crear -->
    @include('calidad.tipoPatron.crearTipoPatron')
    
    <!-- Table -->
    @include('calidad.tipoPatron.tabla')
    
</div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}"> 
@endsection

@section('js')
    <script src="{{ asset('js/custom.js') }}"></script> 
@endsection
