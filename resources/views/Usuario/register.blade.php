@extends('layout.app')

@section('content')
<div class="container">
    <h1>Registro de Usuario</h1>

    {{-- Mensaje de éxito --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Mensaje de error general --}}
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Errores de validación o API --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('usuario.register') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Nombre:</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Apellido:</label>
            <input type="text" name="lastname" class="form-control" value="{{ old('lastname') }}" required>
            @error('lastname')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Teléfono:</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
            @error('phone')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>DUI:</label>
            <input type="text" name="dui" class="form-control" value="{{ old('dui') }}" required>
            @error('dui')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Correo Electrónico:</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Contraseña:</label>
            <input type="password" name="password" class="form-control" required>
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Confirmar Contraseña:</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Rol:</label>
            <select name="role" class="form-control" required>
                <option value="">Seleccione un rol</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrador</option>
                <option value="mesero" {{ old('role') == 'mesero' ? 'selected' : '' }}>Mesero</option>
                <option value="cocinero" {{ old('role') == 'cocinero' ? 'selected' : '' }}>Cocinero</option>
            </select>
            @error('role')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <br>
        <button type="submit" class="btn btn-success">Registrar</button>
        <a href="{{ url('/') }}" class="btn btn-primary">Volver</a>
    </form>
</div>
@endsection
