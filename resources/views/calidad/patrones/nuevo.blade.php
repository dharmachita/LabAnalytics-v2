@extends('adminlte::page')

@section('content_header')
<!-- Mensaje -->
@include('calidad.patrones.mensaje')
<!-- Titulo de sección -->
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">
                Crear Patrón de Calibración
            </h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url('/patrones')}}">Patrones</a></li></li>
            <li class="breadcrumb-item active">Nuevo</li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container mt-2">
    <div class="card">
        <div class="card-body">
            <form action="{{url('/patrones/nuevo')}}" method="POST" role="form">
            {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <!-- Fecha de Alta -->
                        <div class="card">
                        <div class="card-header subform-card">
                            Datos Principales
                        </div>
                        <div class="card-body">    
                        <div class="form-group">
                            <label for="fecha_alta">Fecha de Alta</label>
                            <input type="date" 
                            class="form-control {{ $errors->has('fecha_alta') ? 'is-invalid' : '' }}" value="{{ old('fecha_alta') }}" 
                            name="fecha_alta">
                            @if ($errors->has('fecha_alta'))
                                <div class="invalid-feedback">
                                {{ $errors->first('fecha_alta') }}
                                </div>
                            @endif    
                        </div>
                        <!-- Marca -->
                        <div class="form-group">
                            <label for="marca">Marca</label>
                            <input type="text" 
                            class="form-control {{ $errors->has('marca') ? 'is-invalid' : '' }}" value="{{ old('marca') }}" 
                            name="marca">
                            @if ($errors->has('marca'))
                                <div class="invalid-feedback">
                                {{ $errors->first('marca') }}
                                </div>
                            @endif 
                        </div>
                        <!-- Serie -->
                        <div class="form-group">
                            <label for="serie">Número de Serie</label>
                            <input type="text" 
                            class="form-control {{ $errors->has('serie') ? 'is-invalid' : '' }}" value="{{ old('serie') }}" 
                            name="serie">
                            @if ($errors->has('serie'))
                                <div class="invalid-feedback">
                                {{ $errors->first('serie') }}
                                </div>
                            @endif 
                        </div>
                        <!-- Tipo de Patrón -->
                        <div class="form-group">
                            <label for="tipo_patron_id">Tipo de Patrón</label>
                            <select class="form-control {{ $errors->has('tipo_patron_id') ? 'is-invalid' : '' }}" 
                                name="tipo_patron_id">
                                <option value="" dissabled hidden>--Seleccionar opción--</option>
                                @foreach($tipoPatrones as $tipoPatron)
                                <option value="{{$tipoPatron->id}}">{{$tipoPatron->nombre}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('tipo_patron_id'))
                                <div class="invalid-feedback">
                                {{ $errors->first('tipo_patron_id') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-header subform-card">
                                Datos de Calibración
                            </div>
                            <div class="card-body">
                                <!-- Valor Nominal -->
                                <div class="form-group">
                                    <label for="valor_nominal">Valor Nominal</label>
                                    <input type="text"
                                    class="form-control {{ $errors->has('valor_nominal') ? 'is-invalid' : '' }}" value="{{ old('valor_nominal') }}" 
                                    name="valor_nominal">
                                    @if ($errors->has('valor_nominal'))
                                        <div class="invalid-feedback">
                                        {{ $errors->first('valor_nominal') }}
                                        </div>
                                    @endif 
                                </div>
                                <!-- Unidad de Medida -->
                                <div class="form-group">
                                    <label for="unidad_medida">Unidad de Medida</label>
                                    <input type="text" id="unidad_medida"
                                    class="form-control {{ $errors->has('unidad_medida') ? 'is-invalid' : '' }}" value="{{ old('unidad_medida') }}" 
                                    name="unidad_medida">
                                    @if ($errors->has('unidad_medida'))
                                        <div class="invalid-feedback">
                                        {{ $errors->first('unidad_medida') }}
                                        </div>
                                    @endif 
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="row">
                    <!-- Buttons -->
                    <div class="col-md-4">
                        <button type="reset" class="btn btn-secondary">Limpiar</button>
                        <button type="submit" class="btn btn-primary">Crear</button>
                    </div>
                </div>  
            </form>
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
