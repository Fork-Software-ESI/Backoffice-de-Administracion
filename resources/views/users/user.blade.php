<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vista - User</title>
    <style>
        #botonLogout {
            position: absolute;
            top: 0;
            right: 0;
        }
    </style>
</head>
<body>
    <a href="{{ route('home') }}">Volver al menú principal</a>
    <h1>Bienvenido a la user view</h1>
    <ol>
        <li><a href="{{ route('mostrarUsuarios') }}">Mostrar usuarios</a></li>
        <li><a href="{{ route('vistaBuscarUsuario') }}">Buscar usuarios y eliminar o editar el mismo</a></li>
        <li><a href="{{ route('crearUsuario') }}">Crear usuario</a></li>
        <li><a href="{{ route('vistaAsignarCamion') }}">Asignar un chofer a un camion</a></li>
    </ol>

    <form action="{{ route('auth.logout') }}" method="GET">
        @csrf
        <button id="botonLogout" type="submit">Cerrar sesión</button>
    </form>
</body>
</html>