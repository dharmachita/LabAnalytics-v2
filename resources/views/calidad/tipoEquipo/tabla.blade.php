<div class="container">
    @if(count($tipos) != 0)
        <table class="table table-striped table-dark table-hover">
            <thead>
            <tr>
                <th scope="col text-center">#</th>
                <th scope="col text-center">Nombre</th>
                <th scope="col text-center">Uso General</th>
                <th scope="col text-center">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($tipos as $key=>$tipo)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$tipo->nombre}}</td>
                <td>{{$tipo->uso}}</td>
                <td>
                    <button 
                    type="button" 
                    class="btn btn-danger btn-sm mb-1"
                    data-toggle="modal" data-target="#DeleteModal{{$key}}"
                    >Eliminar
                    </button>
                    <a href="/tipo_equipo/{{$tipo->id}}/edit" 
                    type="button" 
                    class="btn btn-secondary btn-sm mb-1"                        
                    >Editar
                    </a>     
                </td>   
            </tr>
            @include('calidad.tipoEquipo.modals.deleteTipoEquipoModal') 
            @endforeach
            </tbody>
        </table>
    @else
    <div class="card">
        <div class="card-header">
            <strong>Información</strong> 
        </div>
        <div class="card-body">
            <p class="card-text">No se han encontrado registros para mostrar.</p>
        </div>
    </div> 
    @endif       
</div>