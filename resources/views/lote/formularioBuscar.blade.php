<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lote - Buscar</title>
    <style>
        #botonLogout {
            position: absolute;
            top: 0;
            right: 0;
        }
    </style>
</head>
<body>
    <a href="{{ route('vistaLote') }}">Volver al menú principal</a><br>
    @if (session('mensaje'))
        {{ session('mensaje') }}
    @endif
    <h2>Bienvenido a Buscar Lote</h2>
    <form action="{{ route('buscarLote') }}" method="post">
        @csrf
        <label for="id">Ingrese la id del lote:</label>
        <input type="number" name="id" id="id" required>
        <button type="submit">Buscar</button>
    </form>
    <form action="{{ route('auth.logout') }}" method="GET">
        @csrf
        <button id="botonLogout" type="submit">Cerrar sesión</button>
    </form>
</body>
</html>