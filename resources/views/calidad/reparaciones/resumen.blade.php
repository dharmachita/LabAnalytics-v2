@if(count($reparaciones) != 0)
<div class="container">
    <div class="row mb-2">
        <h5>Últimas Reparaciones</h5>
    </div>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col text-center">#</th>
                <th scope="col text-center">Fecha</th>
                <th scope="col text-center">Descripción</th>
                <th scope="col text-center">Proveedor</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reparaciones as $key=>$reparacion)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$reparacion->fecha_reparacion->format('d-m-Y')}}</td>
                <td>{{$reparacion->descripcion}}</td>
                <td>{{$reparacion->proveedor}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @if($cantidadRep>5)
    <div class="row left-row">
        <a href="#" class="btn btn-primary">Ver Mas...</a>
    </div>
    @endif
</div>
@endif


     
