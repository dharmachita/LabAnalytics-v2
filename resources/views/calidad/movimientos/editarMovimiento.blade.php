@extends('adminlte::page')

@section('content')
<div class="container">
    <!-- Titulo de sección -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">
                    Editar Evento
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="/movimientos">Movimientos</a></li>
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
                        <form action="/movimientos/{{$movimiento->id}}" method="POST" role="form">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}
                            <div class="form-group">
                                <label for="instrumento_id">Instrumento</label>
                                <select class="form-control {{ $errors->has('instrumento_id') ? 'is-invalid' : '' }}" 
                                    name="instrumento_id">
                                    @foreach($instrumentos as $instrumento)
                                    <option value="{{$instrumento->id}}" {{$instrumento->id == $movimiento->instrumento_id ? 'selected':''}}>{{$instrumento->instrumento}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('instrumento_id'))
                                    <div class="invalid-feedback">
                                    {{ $errors->first('instrumento_id') }}
                                    </div>
                                @endif
                            </div>   
                            <div class="form-group">
                                <label for="fecha_movimiento">Fecha de Evento</label>
                                <input type="date" 
                                class="form-control {{ $errors->has('fecha_movimiento') ? 'is-invalid' : '' }}" value="{{ $movimiento->fecha_movimiento->format('yy-m-d') }}" 
                                name="fecha_movimiento">
                                @if ($errors->has('fecha_movimiento'))
                                    <div class="invalid-feedback">
                                    {{ $errors->first('fecha_movimiento') }}
                                    </div>
                                @endif    
                            </div>
                            <div class="form-group">
                                <label for="descripcion">Descripcion</label>
                                <textarea value="{{ $movimiento->descripcion }}" name="descripcion" class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}">{{$movimiento->descripcion}}
                                </textarea>
                                @if ($errors->has('descripcion'))
                                    <div class="invalid-feedback">
                                    {{ $errors->first('descripcion') }}
                                    </div>
                                @endif    
                            </div>
                            <a href="/movimientos"" class="btn btn-danger">Volver</a>          
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
