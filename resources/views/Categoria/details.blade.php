@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalles de la Categoría</h1>
    <p><strong>Nombre:</strong> {{ $categoria['nombre'] }}</p>
    <p><strong>Descripción:</strong> {{ $categoria['descripcion'] }}</p>
    <a href="{{ route('categoria.index') }}" class="btn btn-secondary">Volver</a>
</div>
@endsection