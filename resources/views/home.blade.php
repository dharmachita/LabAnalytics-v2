@extends('adminlte::page')

@section('content_header')
<!-- Titulo de sección -->
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">
                Tablero
            </h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container">

Aquí iria toda la información del panel principal

</div>
@endsection

@section('css')
    <link rel="stylesheet" href="/css/admin_costom.css"> 
@endsection
