<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <style>
        #botonLogout {
            position: absolute;
            top: 0;
            right: 0;
        }
    </style>
</head>

<body>
    <h1>Bienvenido 
        @if (session('bienvenida'))
                {{ session('bienvenida') }}
        @endif
    </h1>
    <ol>
        <li><a href="{{ route('vistaUsuario') }}">Usuarios</a></li>
        <li><a href="{{ route('vistaAlmacen') }}">Almacenes</a></li>
        <li><a href="{{ route('vistaPaquete') }}">Paquetes</a></li>
        <li><a href="{{ route('vistaLote') }}">Lotes</a></li>
        <li><a href="{{ route('vistaEstanteria') }}">Estanterias</a></li>
        <li><a href="{{ route('vistaCamion') }}">Camiones</a></li>
    </ol>

    <form action="{{ route('auth.logout') }}" method="GET">
        @csrf
        <button id="botonLogout" type="submit">Cerrar sesión</button>
    </form>
</body>



</html>
