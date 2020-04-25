<div class="container">
    <div class="row">
        <div class="col-md-8 mb-2">
            <a href="equipos/nuevo" class="btn btn-success"><i class="fas fa-plus-circle pr-1"></i>Crear</a> 
        </div>
        @include('search_form')  
    </div>
    
    
    @if(count($equipos) != 0)
        <table class="table table-striped table-dark table-hover">
            <thead>
            <tr>
                <th scope="col text-center">#</th>
                <th scope="col text-center">Nro de Equipo</th>
                <th scope="col text-center">Tipo</th>
                <th scope="col text-center">Marca</th>
                <th scope="col text-center">Modelo</th>
                <th scope="col text-center">Serie</th>
                <th scope="col text-center">Ubicación</th>
                <th scope="col text-center">Acciones</th>
            </tr>
            </thead>
            <tbody class="tablaBusqueda">
            @foreach ($equipos as $key=>$equipo)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$equipo->nro_equipo}}</td>
                <td>{{$equipo->tipo}}</td>
                <td>{{$equipo->marca}}</td>
                <td>{{$equipo->modelo}}</td>
                <td>{{$equipo->serie}}</td>
                <td>{{$equipo->ubicacion}}</td>
                <td>
                    <a href="/equipos/detalle/{{$equipo->id}}" 
                    type="button" 
                    class="btn btn-primary btn-sm mb-1"                        
                    >Ver Detalle...
                    </a>  
                </td>   
            </tr>
             
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