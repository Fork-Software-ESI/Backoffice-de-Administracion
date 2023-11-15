<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Camion - Buscar</title>
    <style>
        #botonLogout {
            position: absolute;
            top: 0;
            right: 0;
        }
    </style>
</head>
<body>
    <a href="{{ route('vistaCamion') }}">Volver al menú de Camión</a><br>
    @if (session('mensaje'))
        {{ session('mensaje') }}
    @endif
    <h2>Bienvenido a Buscar Camión</h2>
    <form action="{{ route('buscarCamion') }}" method="post">
        @csrf
        <label for="matricula">Ingrese la matricula del camion:</label>
        <input type="text" name="matricula" id="matricula" required>
        <button type="submit">Buscar</button>
    </form>
    <form action="{{ route('auth.logout') }}" method="GET">
        @csrf
        <button id="botonLogout" type="submit">Cerrar sesión</button>
    </form>
</body>
</html>