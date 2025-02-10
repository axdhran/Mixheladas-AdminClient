@extends('layout.app')

@section('content')
<div class="container">
    <h1>Lista de Productos</h1>
    
    <!-- Barra de búsqueda -->
    <form method="GET" action="{{ route('producto.index') }}" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Buscar productos" value="{{ request()->get('search') }}">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">Buscar</button>
            </div>
        </div>
    </form>
    

    <!-- Botones de acción -->
    <a href="{{ route('producto.create') }}" class="btn btn-success mb-3">Crear Producto</a>
    <a href="{{ route('home') }}" class="btn btn-secondary mb-3">Volver</a>

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

        <div class="d-flex justify-content-center">
            <ul class="pagination">
                <!-- Mostrar solo "Previous" si la página no es la primera -->
                @if ($data->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link">Previous</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $data->previousPageUrl() }}">Previous</a>
                    </li>
                @endif
        
                <!-- Mostrar solo "Next" si la página no es la última -->
                @if ($data->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $data->nextPageUrl() }}">Next</a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link">Next</span>
                    </li>
                @endif
            </ul>
        </div>

    @else
        <p class="mt-3">No hay productos registradas.</p>
    @endif
</div>
@endsection
