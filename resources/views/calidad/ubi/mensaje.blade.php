@if(session('success'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        La ubicación <strong>{{session('success')}}</strong> ha sido eliminada.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif