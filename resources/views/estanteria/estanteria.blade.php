<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    <h1>Bienvenido a la view de estanterias</h1>
    <ol>
        <li><a href="{{ route('mostrarEstanteria') }}">Mostrar estanterias</a></li>
        <li><a href="{{ route('vistaBuscarEstanteria') }}">Buscar estanteria y eliminar o editar la misma</a></li>
        <li><a href="{{ route('crearEstanteria') }}">Crear estanteria</a></li>
    </ol>
    <form action="{{ route('auth.logout') }}" method="GET">
        @csrf
        <button id="botonLogout" type="submit">Cerrar sesión</button>
    </form>
</body>
</html>