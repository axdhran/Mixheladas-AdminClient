@extends('layout.app')

@section('content')
<div class="container">
    <h1>Crear Mesa</h1>
    <form action="{{ route('mesa.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="numero">Numero de Mesa</label>
            <input type="number" name="numero" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="capacidad">Capacidad</label>
            <input type="number" name="capacidad" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="estado">Estado</label>
            <select name="estado" class="form-control" required>
                <option value="disponible">Disponible</option>
                <option value="ocupada">Ocupada</option>
                <option value="reservada">Reservada</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
</div>
@endsection
