@extends('layout.app')

@section('content')
<div class="container">
    <h1>Categorías</h1>
    <a href="{{ route('categoria.create') }}" class="btn btn-primary">Crear Nueva</a>

    @if(count($data) > 0)
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $categoria)
                <tr>
                    <td>{{ $categoria['nombre'] }}</td>
                    <td>{{ $categoria['descripcion'] }}</td>
                    <td>
                        <a href="{{ route('categoria.edit', $categoria['id']) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('categoria.destroy', $categoria['id']) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro?');">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="mt-3">No hay categorías registradas.</p>
    @endif
</div>
@endsection
