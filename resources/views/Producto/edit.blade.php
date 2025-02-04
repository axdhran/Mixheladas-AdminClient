@extends('layout.app')

@section('content')
<div class="container">
    <h1>Editar Producto</h1>
    <a href="{{ route('producto.index') }}" class="btn btn-primary">Volver</a>

    <form action="{{ route('producto.update', $producto['id']) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Nombre:</label>
            <input type="text" name="nombre" class="form-control" value="{{ $producto['nombre'] }}" required>
        </div>

        <div class="form-group">
            <label>Descripción:</label>
            <textarea name="descripcion" class="form-control" required>{{ $producto['descripcion'] }}</textarea>
        </div>

        <div class="form-group">
            <label>Precio:</label>
            <input type="number" name="precio" class="form-control" step="0.01" value="{{ $producto['precio'] }}" required>
        </div>

        <div class="form-group">
            <label for="categoria_id">Categoría:</label>
            <select name="categoria_id" id="categoria_id" class="form-control" required>
                <option value="">Seleccione una categoría</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria['id'] }}" 
                        {{ (isset($producto['categoria']) && $producto['categoria'] == $categoria['id']) ? 'selected' : '' }}>
                        {{ $categoria['nombre'] }}
                    </option>
                @endforeach
            </select>
        </div>


        <button type="submit" class="btn btn-warning">Actualizar</button>
    </form>
</div>
@endsection
