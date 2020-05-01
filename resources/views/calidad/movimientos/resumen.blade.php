@if(count($movimientos) != 0)
<div class="container">
    <div class="row mb-2">
        <h5>Últimos Movimientos</h5>
    </div>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col text-center">#</th>
                <th scope="col text-center">Fecha de Ocurrencia</th>
                <th scope="col text-center">Descripción</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($movimientos as $key=>$movimiento)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$movimiento->fecha_movimiento->format('d-m-Y')}}</td>
                <td>{{$movimiento->descripcion}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @if($cantidadMov>5)
    <div class="row left-row">
        <a href="#" class="btn btn-primary">Ver Mas...</a>
    </div>
    @endif
</div>
@endif


     
