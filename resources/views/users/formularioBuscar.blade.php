<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Usuario - Buscar Usuario</title>
    <style>
        #botonLogout {
            position: absolute;
            top: 0;
            right: 0;
        }
    </style>
</head>

<body>
    <a href="{{ route('vistaUsuario') }}">Volver al menú Usuario</a><br>
    @if (session('mensaje'))
        {{ session('mensaje') }}
        <br><br>
    @endif
    <h1>Bienvenido a Buscar Usuario</h1>
    <form action="{{ route('buscarUsuario') }}" method="post">
        @csrf
        <label for="username">Ingrese el username del usuario:</label>
        <input type="text" name="username" id="username" required>
        <button type="submit">Buscar</button>
    </form>
    <form action="{{ route('auth.logout') }}" method="GET">
        @csrf
        <button id="botonLogout" type="submit">Cerrar sesión</button>
    </form>
</body>

</html>
