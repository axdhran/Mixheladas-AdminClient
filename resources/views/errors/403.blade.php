@extends('layouts.app')

@section('title', 'Acceso Denegado')

@section('content')
<div class="container text-center">
    <h1 class="text-danger mt-5">403 - Acceso Denegado</h1>
    <p>No tienes permisos para acceder a esta página.</p>
    <a href="{{ route('home') }}" class="btn btn-primary">Volver al inicio</a>
</div>
@stop
