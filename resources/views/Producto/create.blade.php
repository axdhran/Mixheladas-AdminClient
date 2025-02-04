@extends('layout.app')

@section('content')
<div class="container">
    <h1>Crear Producto</h1>
    <a href="{{ route('producto.index') }}" class="btn btn-primary">Volver</a>

    <form action="{{ route('producto.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Nombre:</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Descripción:</label>
            <textarea name="descripcion" class="form-control" required></textarea>
        </div>

        <div class="form-group">
            <label>Precio:</label>
            <input type="number" name="precio" class="form-control" step="0.01" required>
        </div>

        <div class="form-group">
            <label>Categoría:</label>
            <select name="categoria_id" class="form-control" required>
                <option value="">Seleccione una categoría</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria['id'] }}">{{ $categoria['nombre'] }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
</div>
@endsection
