@if(session('success'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        El tipo de patrón: <strong>{{session('success')}}</strong> ha sido eliminado.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if(session('edition'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{session('edition')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif