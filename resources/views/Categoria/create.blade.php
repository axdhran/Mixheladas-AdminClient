@extends('layout.app')

@section('content')
<div class="container">
    <h1>Crear Categoría</h1>
    <form action="{{ route('categoria.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('categoria.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection