@extends('adminlte::page')

@section('content_header')
<!-- Mensaje -->
@include('calidad.patrones.mensaje')
<!-- Titulo de sección -->
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">
                Cargar Nueva Reparación de Equipo
            </h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/reparaciones">Reparaciones</a></li></li>
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
            <form action="/reparaciones/nuevo" method="POST" role="form">
            {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <!-- Fecha -->
                        <div class="card">
                        <div class="card-header subform-card">
                            Datos Generales
                        </div>
                        <div class="card-body">    
                        <div class="form-group">
                            <label for="fecha_reparacion">Fecha Ocurencia</label>
                            <input type="date" 
                            class="form-control {{ $errors->has('fecha_reparacion') ? 'is-invalid' : '' }}" value="{{ old('fecha_reparacion') }}" 
                            name="fecha_reparacion">
                            @if ($errors->has('fecha_reparacion'))
                                <div class="invalid-feedback">
                                {{ $errors->first('fecha_reparacion') }}
                                </div>
                            @endif    
                        </div>
                        <!-- Equipo -->
                        <div class="form-group">
                            <label for="equipo_id">Equipo</label>
                            <select class="form-control {{ $errors->has('equipo_id') ? 'is-invalid' : '' }}" 
                                name="equipo_id">
                                <option value="" dissabled hidden>--Seleccionar opción--</option>
                                @foreach($equipos as $equipo)
                                <option value="{{$equipo->id}}">{{$equipo->equipo}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('equipo_id'))
                                <div class="invalid-feedback">
                                {{ $errors->first('equipo_id') }}
                                </div>
                            @endif
                        </div>
                        <!-- Proveedor -->
                        <div class="form-group">
                            <label for="proveedor">Proveedor</label>
                            <input type="text" 
                            class="form-control {{ $errors->has('proveedor') ? 'is-invalid' : '' }}" value="{{ old('proveedor') }}" 
                            name="proveedor">
                            @if ($errors->has('proveedor'))
                                <div class="invalid-feedback">
                                {{ $errors->first('proveedor') }}
                                </div>
                            @endif 
                        </div>
                        <!-- Descripcion -->
                        <div class="form-group">
                            <label for="descripcion">Descripción de la falla</label>
                            <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}"
                                name="descripcion">{{ old('descripcion') }}</textarea>
                            @if ($errors->has('descripcion'))
                                <div class="invalid-feedback">
                                {{ $errors->first('descripcion') }}
                                </div>
                            @endif 
                        </div>
                        
                    </div>
                    </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-header subform-card">
                                Datos de Verificación
                            </div>
                            <div class="card-body">
                                <!-- Verificación -->
                                <div class="form-group">
                                    <label for="verificacion">Detalle de Verificación</label>
                                    <textarea class="form-control {{ $errors->has('verificacion') ? 'is-invalid' : '' }}"
                                        name="verificacion">{{ old('verificacion') }}</textarea>
                                    @if ($errors->has('verificacion'))
                                        <div class="invalid-feedback">
                                        {{ $errors->first('verificacion') }}
                                        </div>
                                    @endif 
                                </div>
                                <!-- Costo -->
                                <div class="form-group">
                                    <label for="costo">Costo de Reparacion (ARS)</label>
                                    <input type="text" id="costo"
                                    class="form-control {{ $errors->has('costo') ? 'is-invalid' : '' }}" value="{{ old('costo') }}" 
                                    name="costo">
                                    @if ($errors->has('costo'))
                                        <div class="invalid-feedback">
                                        {{ $errors->first('costo') }}
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
                        <button type="submit" class="btn btn-primary">Cargar</button>
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
