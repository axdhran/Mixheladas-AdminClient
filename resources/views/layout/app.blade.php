<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Vincula tu archivo de CSS -->
    <!-- Agrega la librería de Bootstrap para las alertas (si no la tienes) -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Barra de navegación -->
    <nav>
        <ul>
            <li><a href="#">Inicio</a></li>
            <li><a href="#">Acerca de</a></li>
            <li><a href="#">Contacto</a></li>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit">Cerrar sesión</button>
            </form>
        </ul>
    </nav>

    <!-- Contenido principal -->
    <div class="container">
        @yield('content') <!-- Aquí se inyectará el contenido específico de cada vista -->
    </div>

    <!-- Pie de página -->
    <footer>
        <p>&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}</p>
    </footer>

    <!-- Vincula tu archivo de JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
</body>
</html>
