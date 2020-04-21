@extends('adminlte::page')

@section('content')
<div class="container">
    <!-- Titulo de sección -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">
                    Tipos de Equipos de Laboratorio
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Tipo_Equipo</li>
                </ol>
            </div>
            </div>
        </div>
    </div>
    
    <!-- Tabla de Resultados -->
    <div>
        <!-- Table -->
        @if(count($tipos) != 0)
            <table class="table table-striped table-dark table-hover">
			  <thead>
			    <tr>
			      <th scope="col">#</th>
			      <th scope="col">Nombre</th>
			      <th scope="col">Uso</th>
			      <th scope="col">Acciones</th>
			    </tr>
			  </thead>
			  <tbody>
                @foreach ($tipos as $tipo)
                <tr>
			      	<td>{{$tipo->id}}</td>
			      	<td>{{$tipo->nombre}}</td>
			      	<td>{{$tipo->uso}}</td>
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