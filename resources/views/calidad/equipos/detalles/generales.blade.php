<div class="row">
    <div class="col-md-6 col-sm-12 equipo-img-frame">
       <img src="{{asset('img/equipos/'.$equipo->imagen)}}" width="300" height="300">
    </div>
    <div class="col-md-6 col-sm-12">
        <p><strong>Fecha de alta: </strong>{{$equipo->fecha_alta->format('d-m-Y')}}</p>
        <p><strong>Marca: </strong>{{$equipo->marca}}</p>
        <p><strong>Modelo: </strong>{{$equipo->modelo}}</p>
        <p><strong>Serie: </strong>{{$equipo->serie}}</p>
        <p><strong>Ubicación: </strong>{{$equipo->ubicacion}}</p>
        <p><strong>Rango: </strong>{{$equipo->rango}}</p>
        <p><strong>Error Máximo: </strong>{{$equipo->emp}}</p>
        <p><strong>Apreciación: </strong>{{$equipo->apreciacion}}</p>
    </div>
</div>