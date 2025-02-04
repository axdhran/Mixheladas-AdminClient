@extends('layout.app')

@section('content')
<div class="container">
    <h1>Editar Mesa</h1>
    <form action="{{ route('mesa.update', $mesa['id']) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="numero">Numero de Mesa</label>
            <input type="number" name="numero" class="form-control" value="{{ $mesa['capacidad'] }}" required>
        </div>

        <div class="form-group">
            <label for="capacidad">Capacidad</label>
            <input type="number" name="capacidad" class="form-control" value="{{ $mesa['capacidad'] }}" required>
        </div>

        <div class="form-group">
            <label for="estado">Estado</label>
            <select name="estado" class="form-control" required>
                <option value="disponible" {{ $mesa['estado'] == 'disponible' ? 'selected' : '' }}>Disponible</option>
                <option value="ocupada" {{ $mesa['estado'] == 'ocupada' ? 'selected' : '' }}>Ocupada</option>
                <option value="reservada" {{ $mesa['estado'] == 'reservada' ? 'selected' : '' }}>Reservada</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Actualizar</button>
    </form>
</div>
@endsection