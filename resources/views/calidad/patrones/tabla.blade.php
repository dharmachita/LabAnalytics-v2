<div class="container">
    
    <div class="row">
        <div class="col-md-8 mb-2">
            <a href="patrones/nuevo" class="btn btn-success"><i class="fas fa-plus-circle pr-1"></i>Crear</a> 
        </div>
        @include('search_form')  
    </div>

    @if(count($patrones) != 0)
        <table class="table table-striped table-dark table-hover">
            <thead>
            <tr>
                <th scope="col text-center">#</th>
                <th scope="col text-center">Serie</th>
                <th scope="col text-center">Valor Nominal</th>
                <th scope="col text-center">Unidad de Medida</th>
                <th scope="col text-center">Tipo Patrón</th>
                <th scope="col text-center">Acciones</th>
            </tr>
            </thead>
            <tbody class="tablaBusqueda">
            @foreach ($patrones as $key=>$patron)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$patron->serie}}</td>
                <td>{{$patron->valor_nominal}}</td>
                <td>{{$patron->unidad_medida}}</td>
                <td>{{$patron->tipo}}</td>
                <td>
                    <a href="/patrones/detalle/{{$patron->id}}" 
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