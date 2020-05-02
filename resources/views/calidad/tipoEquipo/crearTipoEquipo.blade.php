<div class="container">
    <div class="row">
        <div class="container pb-3">
            <button class="btn btn-success" onclick="showNewTipoEquipo()"><i class="fas fa-plus-circle pr-1"></i>Crear</button>
        </div>
    </div>
    <div class="row {{ $errors->any() ? 'show-row' : 'hide-row'}}" id="crearTipoEquipo">
        <div class="col-md-6 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <b>Crear Tipo de Equipo</b>
                </div>
                <div class="card-body">
                    <form action="/tipo_equipo" method="POST" role="form">
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
                            <label for="uso">Uso General</label>
                            <input type="text" 
                            class="form-control {{ $errors->has('uso') ? 'is-invalid' : '' }}" value="{{ old('uso') }}" 
                            name="uso">
                            @if ($errors->has('uso'))
                                <div class="invalid-feedback">
                                {{ $errors->first('uso') }}
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