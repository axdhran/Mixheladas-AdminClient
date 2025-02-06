@extends('layout.app')

@section('content')
<div class="container">
    <h1>Editar Categoría</h1>

    @if(isset($categoria))
        <form action="{{ route('categoria.update', $categoria['id']) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $categoria['nombre'] }}" required>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="form-control" required>{{ $categoria['descripcion'] }}</textarea>
            </div>
            <br>
            <button type="submit" class="btn btn-warning">Actualizar</button>
            <a href="{{ route('categoria.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    @else
        <p class="text-danger">No se encontraron datos de la categoría.</p>
    @endif

</div>
@endsection

