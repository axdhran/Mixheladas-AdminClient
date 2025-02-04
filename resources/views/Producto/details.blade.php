@extends('layout.app')

@section('content')
<div class="container">
    <h1>Detalles del Producto</h1>
    <a href="{{ route('producto.index') }}" class="btn btn-primary">Volver</a>

    <table class="table">
        <tr>
            <th>Nombre:</th>
            <td>{{ $producto['nombre'] }}</td>
        </tr>
        <tr>
            <th>Descripción:</th>
            <td>{{ $producto['descripcion'] }}</td>
        </tr>
        <tr>
            <th>Precio:</th>
            <td>${{ $producto['precio'] }}</td>
        </tr>
        <tr>
            <th>Categoría:</th>
            <td>{{ $producto['categoria'] }}</td>
        </tr>
    </table>
</div>
@endsection
