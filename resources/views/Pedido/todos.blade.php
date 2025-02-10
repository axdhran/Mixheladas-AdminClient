@extends('layout.app')

@section('content')
<div class="container">
    <h1>Lista de Pedidos</h1>
    <a href="{{ route('home') }}" class="btn btn-secondary">Volver</a>
    <a href="{{ route('pedido.create') }}" class="btn btn-success">Crear Pedido</a>
    @if(count($data) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Mesa</th>
                    <th>Estado</th>
                    <th>Total</th>
                    <th>Fecha</th>
                    <th>Detalles</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $pedido)
                <tr>
                    <td>{{ $pedido['id'] }}</td>
                    <td>{{ $pedido['mesa'] }}</td>
                    <td>{{ $pedido['estado'] }}</td>
                    <td>${{ $pedido['total'] }}</td>
                    <td>{{ $pedido['created_at'] }}</td>
                    <td>
                        <button class="btn btn-info" data-bs-toggle="collapse" data-bs-target="#pedido-{{ $pedido['id'] }}" aria-expanded="false" aria-controls="pedido-{{ $pedido['id'] }}">
                            Ver detalles
                        </button>
                        
                        <div id="pedido-{{ $pedido['id'] }}" class="collapse">
                            <table class="table mt-2">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Precio Unitario</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pedido['items'] as $item)
                                    <tr>
                                        <td>{{ $item['producto'] }}</td>
                                        <td>{{ $item['cantidad'] }}</td>
                                        <td>${{ $item['precio_unitario'] }}</td>
                                        <td>${{ $item['subtotal'] }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="mt-3">No hay pedidos registrados.</p>
    @endif
</div>
<!-- Asegurar que Bootstrap JS está cargado -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
