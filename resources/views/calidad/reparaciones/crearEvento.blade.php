<div class="container">
    @if(Auth::user()->tipoUsuario=='calidad')
    <div class="row">  
        <div class="container pb-3">
            <button class="btn btn-success" onclick="showNewTipoEquipo()"><i class="fas fa-plus-circle pr-1"></i>Incluir Evento</button>
        </div>
    </div>
    <div class="row {{ $errors->any() ? 'show-row' : 'hide-row'}}" id="crearTipoEquipo">
        <div class="col-md-6 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <b>Incluir Evento</b>
                </div>
                <div class="card-body">
                    <form action="/reparaciones/crear_evento" method="POST" role="form">
                    {{ csrf_field() }}
                        <div class="form-group">
                            <label for="fecha_evento">Fecha</label>
                            <input type="date" 
                            class="form-control {{ $errors->has('fecha_evento') ? 'is-invalid' : '' }}" value="{{ old('fecha_evento') }}" 
                            name="fecha_evento">
                            @if ($errors->has('fecha_evento'))
                                <div class="invalid-feedback">
                                {{ $errors->first('fecha_evento') }}
                                </div>
                            @endif    
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <input type="text" 
                            class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" value="{{ old('descripcion') }}" 
                            name="descripcion">
                            @if ($errors->has('descripcion'))
                                <div class="invalid-feedback">
                                {{ $errors->first('descripcion') }}
                                </div>
                            @endif 
                        </div> 
                        <div class="form-group hide-row">
                            <label for="reparacion_id">ID Reparacion</label>
                            <input type="text" 
                            class="form-control {{ $errors->has('reparacion_id') ? 'is-invalid' : '' }}" value="{{$reparacion->id}}"
                            name="reparacion_id">
                            @if ($errors->has('reparacion_id'))
                                <div class="invalid-feedback">
                                {{ $errors->first('reparacion_id') }}
                                </div>
                            @endif 
                        </div>             
                        <button type="reset" class="btn btn-secondary">Limpiar</button>
                        <button type="submit" class="btn btn-primary">Crear</button>   
                    </form>   
                </div>
            </div>
        </div>
    </div>
    @endif            
</div>     