@extends('adminlte::page')

@section('content')
<div class="container">
    <!-- Titulo de sección -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">
                    Editar Tipo de Patrón
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="/tipo_patron">Tipo de Patron</a></li>
                <li class="breadcrumb-item active">Editar</li>
                </ol>
            </div>
            </div>
        </div>
    </div>
    <!-- Editar -->
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <b>Formulario de Edición</b>
                    </div>
                    <div class="card-body">
                        <form action="/tipo_patron/{{$tipo->id}}" method="POST" role="form">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" 
                                class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" value="{{ $tipo->nombre }}" 
                                name="nombre">
                                @if ($errors->has('nombre'))
                                    <div class="invalid-feedback">
                                    {{ $errors->first('nombre') }}
                                    </div>
                                @endif    
                            </div>
                            <div class="form-group">
                                <label for="descripcion">Descripción Breve</label>
                                <input type="text" 
                                class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" value="{{ $tipo->descripcion }}" 
                                name="descripcion">
                                @if ($errors->has('descripcion'))
                                    <div class="invalid-feedback">
                                    {{ $errors->first('descripcion') }}
                                    </div>
                                @endif 
                            </div>   
                            <a href="/tipo_patron"" class="btn btn-danger">Volver</a>          
                            <button type="submit" class="btn btn-primary">Modificar</button>   
                        </form>   
                    </div>
                </div>
            </div>
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
