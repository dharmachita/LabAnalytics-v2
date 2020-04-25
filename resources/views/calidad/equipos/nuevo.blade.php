@extends('adminlte::page')

@section('content_header')
<!-- Mensaje -->
@include('calidad.equipos.mensaje')
<!-- Titulo de sección -->
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">
                Crear Equipo de Laboratorio
            </h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/equipos">Equipos</a></li></li>
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
            <form action="/equipos/nuevo" method="POST" role="form" enctype="multipart/form-data">
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
                        <!-- Modelo -->
                        <div class="form-group">
                            <label for="modelo">Modelo</label>
                            <input type="text" 
                            class="form-control {{ $errors->has('modelo') ? 'is-invalid' : '' }}" value="{{ old('modelo') }}" 
                            name="modelo">
                            @if ($errors->has('modelo'))
                                <div class="invalid-feedback">
                                {{ $errors->first('modelo') }}
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
                        <!-- Tipo de Equipo -->
                        <div class="form-group">
                            <label for="tipo_equipo_id">Tipo de Equipo</label>
                            <select class="form-control {{ $errors->has('tipo_equipo_id') ? 'is-invalid' : '' }}" 
                                name="tipo_equipo_id">
                                <option value="" dissabled hidden>--Seleccionar opción--</option>
                                @foreach($tipoEquipos as $tipoEquipo)
                                <option value="{{$tipoEquipo->id}}">{{$tipoEquipo->nombre}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('tipo_equipo_id'))
                                <div class="invalid-feedback">
                                {{ $errors->first('tipo_equipo_id') }}
                                </div>
                            @endif
                        </div> 
                        <!-- Ubicación -->
                        <div class="form-group">
                            <label for="ubicacion_id">Ubicación</label>
                            <select class="form-control {{ $errors->has('ubicacion_id') ? 'is-invalid' : '' }}" 
                            name="ubicacion_id">
                                <option value="" dissabled hidden>--Seleccionar opción--</option>
                                @foreach($ubicaciones as $ubicacion)
                                <option value="{{$ubicacion->id}}">{{$ubicacion->nombre}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('ubicacion_id'))
                                <div class="invalid-feedback">
                                {{ $errors->first('ubicacion_id') }}
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
                                <!-- Calibrable -->
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" name="es_calibrable" id="cal" value="true">
                                    <label class="form-check-label" for="es_calibrable">¿Equipo sometido a calibración?</label>
                                </div> 
                                <!-- EMP -->
                                <div class="form-group">
                                    <label for="emp">Error Máximo Permisible</label>
                                    <input type="text" id="emp"
                                    class="form-control {{ $errors->has('emp') ? 'is-invalid' : '' }}" value="{{ old('emp') }}" 
                                    name="emp">
                                    @if ($errors->has('emp'))
                                        <div class="invalid-feedback">
                                        {{ $errors->first('emp') }}
                                        </div>
                                    @endif 
                                </div>
                                <!-- Apreciación -->
                                <div class="form-group">
                                    <label for="apreciacion">Apreciación</label>
                                    <input type="text" id="apreciacion"
                                    class="form-control {{ $errors->has('apreciacion') ? 'is-invalid' : '' }}" value="{{ old('apreciacion') }}" 
                                    name="apreciacion">
                                    @if ($errors->has('apreciacion'))
                                        <div class="invalid-feedback">
                                        {{ $errors->first('apreciacion') }}
                                        </div>
                                    @endif 
                                </div> 
                                <!-- Rango -->
                                <div class="form-group">
                                    <label for="rango">Rango</label>
                                    <input type="text"
                                    class="form-control {{ $errors->has('rango') ? 'is-invalid' : '' }}" value="{{ old('rango') }}" 
                                    name="rango" placeholder="Ej: 0-200 gramos">
                                    @if ($errors->has('rango'))
                                        <div class="invalid-feedback">
                                        {{ $errors->first('rango') }}
                                        </div>
                                    @endif 
                                </div> 
                            </div>
                        </div>    
                        <div class="card">
                            <div class="card-header subform-card">
                                Subir Imagen
                            </div>
                            <div class="card-body">
                                <div class="form-group custom-file">
                                    <input type="file" class="custom-file-input {{ $errors->has('imagen') ? 'is-invalid' : '' }}" 
                                    id="customFileLangHTML" name="imagen" accept="image/*">
                                    <label class="custom-file-label" for="image" id="customeFileLabel"
                                    data-browse="Buscar">Seleccionar Imagen</label>
                                        @if ($errors->has('imagen'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('imagen') }}
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
                        <button type="reset" class="btn btn-secondary" id="limpiarEquipo">Limpiar</button>
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
