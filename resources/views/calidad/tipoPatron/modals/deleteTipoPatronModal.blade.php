<!-- Delete -->
<div class="modal fade" id="DeleteModal{{$key}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header dan-modal">
            <h5 class="modal-title" id="staticBackdropLabel">Confirmar</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            ¿Está seguro que desea eliminar el tipo de patrón: <strong> {{$tipo->nombre}}</strong>?
        </div>
        <div class="modal-footer">
            <form action="/tipo_patron/{{$tipo->id}}" method="POST" role="form">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submite" class="btn btn-primary">Aceptar</button> 
            </form> 
        </div>
        </div>
    </div>
</div>