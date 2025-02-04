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
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">MixHeladas</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit">Cerrar sesión</button>
            </form>
        </div>
      </div>
    </nav>
    

   
    <!-- Contenido principal -->
    <div class="container">
        @yield('content') <!-- Aquí se inyectará el contenido específico de cada vista -->
    </div>

    <!-- Pie de página -->
    <footer>
        <p>&copy; {{ date('Y') }} {{ config('osmmany', 'Osmany/Adrian') }}</p>
    </footer>

    <!-- Vincula tu archivo de JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
</body>
</html>
