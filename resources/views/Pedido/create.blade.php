@extends('layout.app')

@section('content') 
    <div class="container mt-4 mb-5">
        <div class="card shadow-lg p-4">
            <h1 class="text-center mb-4">Crear Pedido</h1>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form action="{{ route('pedido.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="mesa_id" class="form-label">Mesa</label>
                    <select name="mesa_id" id="mesa_id" class="form-select" required>
                        <option value="">Seleccione una mesa</option>
                        @foreach($mesas as $mesa)
                            <option value="{{ $mesa['id'] }}">Mesa {{ $mesa['numero'] }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Productos</label>
                    <div id="productos-container">
                        <div class="producto-item mb-3 d-flex gap-2">
                            <select name="items[0][producto_id]" class="form-select" required>
                                <option value="">Seleccione un producto</option>
                                @foreach($productos as $producto)
                                    <option value="{{ $producto['id'] }}">{{ $producto['nombre'] }} - ${{ $producto['precio'] }}</option>
                                @endforeach
                            </select>
                            <input type="number" name="items[0][cantidad]" class="form-control" placeholder="Cantidad" required min="1">
                        </div>
                    </div>
                    <button type="button" id="agregar-producto" class="btn btn-success">Agregar Producto</button>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Crear Pedido</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('agregar-producto').addEventListener('click', function() {
            const container = document.getElementById('productos-container');
            const index = container.children.length;

            const nuevoProducto = document.createElement('div');
            nuevoProducto.classList.add('producto-item', 'mb-3', 'd-flex', 'gap-2');
            nuevoProducto.innerHTML = `
                <select name="items[${index}][producto_id]" class="form-select" required>
                    <option value="">Seleccione un producto</option>
                    @foreach($productos as $producto)
                        <option value="{{ $producto['id'] }}">{{ $producto['nombre'] }} - ${{ $producto['precio'] }}</option>
                    @endforeach
                </select>
                <input type="number" name="items[${index}][cantidad]" class="form-control" placeholder="Cantidad" required min="1">
            `;

            container.appendChild(nuevoProducto);
        });
    </script>
@endsection
