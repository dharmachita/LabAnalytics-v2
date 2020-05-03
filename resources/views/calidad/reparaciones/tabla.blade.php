<div class="container">
    
    <div class="row">
        @if(Auth::user()->tipoUsuario == "calidad")
        <div class="col-md-8 mb-2">
            <a href="reparaciones/nuevo" class="btn btn-success"><i class="fas fa-plus-circle pr-1"></i>Nueva</a> 
        </div>
        @endif
        @include('search_form')  
    </div>

    @if(count($reparaciones) != 0)
        <table class="table table-striped table-dark table-hover tabla-escritorio">
            <thead>
            <tr>
                <th scope="col text-center">#</th>
                <th scope="col text-center">Equipo</th>
                <th scope="col text-center">Fecha</th>
                <th scope="col text-center">Descripción</th>
                <th scope="col text-center">Acciones</th>
            </tr>
            </thead>
            <tbody class="tablaBusqueda">
            @foreach ($reparaciones as $key=>$reparacion)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$reparacion->equipo}}</td>
                <td>{{$reparacion->fecha->format('d-m-yy')}}</td>
                <td>{{$reparacion->descripcion}}</td>
                <td>
                    <a href="reparaciones/{{$reparacion->id}}" 
                    type="button" 
                    class="btn btn-primary btn-sm mb-1"                        
                    >Ver Detalle...
                    </a>     
                </td>   
            </tr>           
            @endforeach
            </tbody>
        </table>
        <table class="table table-striped table-dark table-hover tabla-movil">
            <thead>
                <th scope="col text-center">Equipo</th>
                <th scope="col text-center">Fecha</th>
                <th scope="col text-center">Descripcion</th>
            </thead>
            <tbody class="tablaBusqueda"> 
                @foreach ($reparaciones as $key=>$reparacion)
                <tr>
                    <td>{{$reparacion->equipo}} <p><a href="reparaciones/{{$reparacion->id}}" 
                        type="button" 
                        class="btn btn-primary btn-sm mb-1"                        
                        >Ver...
                        </a> </p>
                    </td>
                    <td>{{$reparacion->fecha->format('d-m-yy')}}</td>
                    <td>{{$reparacion->descripcion}}</td>
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