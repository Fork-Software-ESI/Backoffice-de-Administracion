<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Usuario - Buscar Usuario</title>
</head>
<body>
    <a href="{{ route('vistaUsuario') }}">Volver al menú Usuario</a>
    <h1>Bienvenido a Buscar Usuario</h1>
    <form action="{{ route('buscarUsuario') }}" method="post">
        @csrf
        <label for="username">Ingrese el username del usuario:</label>
        <input type="text" name="username" id="username" required>
        <button type="submit">Buscar</button>
    </form>
</body>
</html>