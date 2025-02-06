@extends('layout.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Usuarios Registrados</h1>

</hr>
    
    @if (!empty($users))
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Teléfono</th>
                    <th>DUI</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Fecha de Registro</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user['id'] }}</td>
                        <td>{{ $user['name'] }}</td>
                        <td>{{ $user['lastname'] }}</td>
                        <td>{{ $user['phone'] }}</td>
                        <td>{{ $user['dui'] }}</td>
                        <td>{{ $user['email'] }}</td>
                        <td>{{ $user['role'] ?? 'Sin rol' }}</td>
                        <td>
                            {{ $user['created_at'] ? \Carbon\Carbon::parse($user['created_at'])->format('d-m-Y H:i:s') : 'No registrado' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No hay usuarios disponibles.</p>
    @endif
</div>
@endsection
