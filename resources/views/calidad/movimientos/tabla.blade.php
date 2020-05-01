<div class="container">
    <div class="row">
        @include('search_form')  
    </div>
    
    
    @if(count($movimientos) != 0)
        <table class="table table-striped table-dark table-hover">
            <thead>
            <tr>
                <th scope="col text-center">#</th>
                <th scope="col text-center">Fecha</th>
                <th scope="col text-center">Instrumento</th>
                <th scope="col text-center">Descripción</th>
                <th scope="col text-center">Acciones</th>
            </tr>
            </thead>
            <tbody class="tablaBusqueda">
            @foreach ($movimientos as $key=>$movimiento)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$movimiento->fecha_movimiento->format('d-m-Y')}}</td>
                <td>{{$movimiento->instrumento}}</td>
                <td>{{$movimiento->descripcion}}</td>
                <td>
                    <a href="" 
                    type="button" 
                    class="btn btn-danger btn-sm mb-1"                        
                    >Eliminar
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