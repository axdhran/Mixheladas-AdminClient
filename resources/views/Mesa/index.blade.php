@extends('layout.app')

@section('content')
<div class="container">
    <h1>Listado de Mesas</h1>
    <a href="{{ route('mesa.create') }}" class="btn btn-primary">Crear Mesa</a>
    <table class="table">
        <thead>
            <tr>
               <th>Numero de Mesa</th>
                <th>Capacidad</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $mesa)
            <tr>
                <td>{{ $mesa['numero'] }}</td>
                <td>{{ $mesa['capacidad'] }}</td>
                <td>{{ $mesa['estado'] }}</td>
                <td>
                    <a href="{{ route('mesa.edit', $mesa['id']) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('mesa.destroy', $mesa['id']) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection