<div class="container">
    <div class="row">
        @include('search_form')  
    </div>
    
    
    @if(count($movimientos) != 0)
        <table class="table table-striped table-dark table-hover">
            <thead>
            <tr>
                <th scope="col text-center" class="tabla-escritorio">#</th>
                <th scope="col text-center">Fecha</th>
                <th scope="col text-center">Instrumento</th>
                <th scope="col text-center">Descripción</th>
                @if(Auth::user()->tipoUsuario=='calidad')
                <th scope="col text-center">Acciones</th>
                @endif
            </tr>
            </thead>
            <tbody class="tablaBusqueda">
            @foreach ($movimientos as $key=>$movimiento)
            <tr>
                <td class="tabla-escritorio">{{$key+1}}</td>
                <td>{{$movimiento->fecha_movimiento->format('d-m-Y')}}</td>
                <td>{{$movimiento->instrumento}}</td>
                <td>{{$movimiento->descripcion}}</td>
                @if(Auth::user()->tipoUsuario=='calidad')
                <td>
                    <button 
                        type="button" 
                        class="btn btn-danger btn-sm mb-1"
                        data-toggle="modal" data-target="#DeleteModalMov{{$key}}"
                        >Eliminar
                    </button>
                    <a href="/movimientos/{{$movimiento->id}}/edit" 
                    type="button" 
                    class="btn btn-secondary btn-sm mb-1"                        
                    >Editar
                    </a>     
                </td>
                @endif   
            </tr>
            @include('calidad.movimientos.modals.deleteMovimientoModal') 
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