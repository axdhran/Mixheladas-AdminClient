<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'MIXHELADAS') }}</title>
    <!-- Vincula tu archivo de CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        /* Asegurar que el contenido ocupe el espacio disponible */
        html, body {
            height: 100%;
        }
        /* Usar flexbox para estructurar el contenido y empujar el footer abajo */
        .wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Asegura que el wrapper cubra toda la altura de la pantalla */
        }
        .content {
            flex: 1; /* Expande el contenido para ocupar el espacio disponible */
            padding: 20px;
        }
        footer {
            text-align: center;
            padding: 15px;
            background: #f8f9fa;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- Barra de navegación -->
        <nav class="navbar navbar-expand-sm navbar-dark bg-warning">
            <div class="container-fluid">
                <a class="navbar-brand">
                    <img src="{{ asset('img/IMG_8218.JPG') }}" alt="Logo" style="width:40px;" class="rounded-pill"> 
                </a>
                <a class="navbar-brand" href="{{ route('home') }}">MIXHELADAS</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="mynavbar">
                    <ul class="navbar-nav me-auto"></ul>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">Cerrar sesión</button>
                    </form>
                </div>
            </div>
        </nav>

        <!-- Contenido principal -->
        <div class="content container">
            @yield('content') <!-- Aquí se inyectará el contenido específico de cada vista -->
        </div>

        <!-- Pie de página -->
        <footer>
            <p>&copy; {{ date('Y') }} {{ config('osmmany', 'Desarrollado por Osmany y Adrian') }}</p>
        </footer>
    </div>

    <!-- Vincula tu archivo de JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>