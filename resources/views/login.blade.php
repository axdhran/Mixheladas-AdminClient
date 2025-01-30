@extends('layout.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h3 class="text-center mb-4">Iniciar Sesión</h3>
            <div class="card">
                <div class="card-body">
                    {{-- Mostrar el mensaje de error si existe --}}
        @if (session('error'))
        <div class="alert alert-danger mt-4">
            {{ session('error') }}
        </div>
    @endif
                    <form method="POST" action="{{ route('login.post') }}">
                        @csrf
                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" id="email" name="email" class="form-control" required autofocus>
                        </div>
                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                        <!-- Submit -->
                        <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
                    </form>
                </div>
            </div>
            <p class="text-center mt-3">
                ¿No tienes cuenta? <a href="#">Regístrate aquí</a>
            </p>
        </div>
    </div>
</div>
@endsection