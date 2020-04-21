@extends('adminlte::page')

@section('content')
<div class="container">
    <!-- Titulo de sección -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">
                    Ubicaciones
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Ubicaciones</li>
                </ol>
            </div>
            </div>
        </div>
    </div>
    <div>
        <!-- Table -->
        @if(count($ubicaciones) != 0)
            <table class="table table-striped table-dark table-hover">
			  <thead>
			    <tr>
			      <th scope="col">#</th>
			      <th scope="col">Nombre</th>
			      <th scope="col">Descripción</th>
			      <th scope="col">Acciones</th>
			    </tr>
			  </thead>
			  <tbody>
                @foreach ($ubicaciones as $ubicacion)
                <tr>
			      	<td>{{$ubicacion->id}}</td>
			      	<td>{{$ubicacion->nombre}}</td>
			      	<td>{{$ubicacion->descripcion}}</td>
			      	<td>
				      	<button 
				      	type="button" 
				      	class="btn btn-danger btn-sm mb-1"				
						>Eliminar
						</button>
						<button 
				      	type="button" 
				      	class="btn btn-secondary btn-sm mb-1"
				      	>Editar
						</button>
					</td>
			    </tr>
                @endforeach
			  </tbody>
			</table>
        @else
        <div class="card">
            <div class="card-header">
                Información
            </div>
            <div class="card-body">
                <p class="card-text">No se han encontrado registros para mostrar.</p>
            </div>
        </div> 
        @endif       
    </div>
</div>
@endsection

@section('css')
    <link rel="stylesheet" href="/css/admin_costom.css"> 
@endsection