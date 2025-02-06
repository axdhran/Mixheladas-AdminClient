@extends('layout.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Lista de Pedidos</h1>

    <div class="row" id="pedidos-container">
        @foreach($data as $pedido)
        <div class="col-md-4 mb-4 pedido-card" data-id="{{ $pedido['id'] }}">
            <div class="card shadow">
                <div class="card-header bg-warning text-white">
                    <h5 class="mb-0">Pedido #{{ $pedido['id'] }}</h5>
                    <small>Mesa: {{ $pedido['mesa'] }}</small>
                </div>
                <div class="card-body">
                    <p><strong>Estado:</strong> 
                        <select class="form-control estado-select" data-id="{{ $pedido['id'] }}">
                            <option value="pendiente" {{ $pedido['estado'] == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                            <option value="completado" {{ $pedido['estado'] == 'completado' ? 'selected' : '' }}>Completado</option>
                            <option value="cancelado" {{ $pedido['estado'] == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                        </select>
                    </p>
                    <p><strong>Total:</strong> ${{ number_format($pedido['total'], 2) }}</p>

                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pedido['items'] as $item)
                            <tr>
                                <td>{{ $item['producto'] }}</td>
                                <td>{{ $item['cantidad'] }}</td>
                                <td>${{ number_format($item['subtotal'], 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-center">
                    <small class="text-muted">Fecha: {{ $pedido['created_at'] }}</small>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('.estado-select').forEach(select => {
            select.addEventListener('change', function() {
                let pedidoId = this.dataset.id;
                let nuevoEstado = this.value;

                fetch(`/pedido/update-estado/${pedidoId}`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ estado: nuevoEstado })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 200) {
                        // Si el estado es "completado" o "cancelado", quitar la tarjeta
                        if (nuevoEstado === 'completado' || nuevoEstado === 'cancelado') {
                            let card = document.querySelector(`.pedido-card[data-id="${pedidoId}"]`);
                            if (card) {
                                card.remove();
                            }
                        }
                    } else {
                        alert("Error al actualizar el estado.");
                    }
                })
                .catch(error => console.error("Error:", error));
            });
        });
    });
</script>
@endsection
