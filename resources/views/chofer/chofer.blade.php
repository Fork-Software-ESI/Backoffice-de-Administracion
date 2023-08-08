<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chofer</title>
</head>
<body>
    <h1>Bienvenido a la chofer view</h1>
    <ol>
        <li><a href="{{ route('chofer.mostrarUsuarios') }}">Mostrar usuarios</a></li>
        <li><a href="{{ route('chofer.buscarUsuario') }}">Buscar usuarios y eliminar o editar el mismo</a></li>
        <li><a href="{{ route('chofer.crearUsuario') }}">Crear usuario</a></li>
    </ol>
</body>
</html>