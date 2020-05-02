<div class="container">
    <div class="row">
        <div class="container pb-3">
            <button class="btn btn-success" onclick="showNewLocation()"><i class="fas fa-plus-circle pr-1"></i>Crear</button>
        </div>
    </div>
    <div class="row {{ $errors->any() ? 'show-row' : 'hide-row'}}" id="crearUbicacion">
        <div class="col-md-6 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <b>Crear Ubicación</b>
                </div>
                <div class="card-body">
                    <form action="/ubicaciones" method="POST" role="form">
                    {{ csrf_field() }}
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" 
                            class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" value="{{ old('nombre') }}" 
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
                            class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" value="{{ old('descripcion') }}" 
                            name="descripcion">
                            @if ($errors->has('descripcion'))
                                <div class="invalid-feedback">
                                {{ $errors->first('descripcion') }}
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
</div>     