@extends('layout.app')

@section('content')
<div class="container">
    <h1>Detalles de la Mesa</h1>
    <p><strong>Numero de MEsa:</strong> {{ $mesa['numero'] }}</p>
    <p><strong>Capacidad:</strong> {{ $mesa['capacidad'] }}</p>
    <p><strong>Estado:</strong> {{ $mesa['estado'] }}</p>
    <a href="{{ route('mesa.index') }}" class="btn btn-secondary">Volver</a>
</div>
@endsection