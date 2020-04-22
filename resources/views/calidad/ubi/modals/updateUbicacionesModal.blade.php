<!-- Update -->
<div class="modal fade" id="UpdateModal{{$key}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header info-modal">
                <h5 class="modal-title" id="staticBackdropLabel">Editar Ubicación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/ubicaciones/{{$ubicacion->id}}" method="POST" role="form">
            {{ method_field('PUT') }}
            {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" 
                        class="form-control" 
                        name="nombre" value="{{$ubicacion->nombre}}">
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <input type="text" 
                        class="form-control" 
                        name="descripcion" value="{{$ubicacion->descripcion}}">
                    </div>
                </div>             
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Aceptar</button>   
                </div>
            </form>
        </div>
    </div>
</div>