@extends('layout.app')

@section('content')
<div class="container">
    <h1>Lista de Productos</h1>
    <a href="{{ route('producto.create') }}" class="btn btn-success">Crear Producto</a>
    <a href="{{ route('home') }}" class="btn btn-secondary">Volver</a>

    @if(count($data) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Categoría</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $producto)
                <tr>
                    <td>{{ $producto['nombre'] }}</td>
                    <td>{{ $producto['descripcion'] }}</td>
                    <td>${{ $producto['precio'] }}</td>
                    <td>{{ $producto['categoria'] }}</td>
                    <td>
                       
                        <a href="{{ route('producto.edit', $producto['id']) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('producto.destroy', $producto['id']) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Seguro que deseas eliminar este producto?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="mt-3">No hay productos registradas.</p>
    @endif
</div>
@endsection
