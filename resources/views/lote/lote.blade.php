<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lote</title>
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
    <h1>Bienvenido a la view de Lote</h1>
    <ol>
        <li><a href="{{ route('mostrarLote') }}">Mostrar Lotes</a></li>
        <li><a href="{{ route('vistaBuscarLote') }}">Buscar Lote y eliminarlo o editarlo</a></li>
        <li><a href="{{ route('crearLote') }}">Crear Lote</a></li>
    </ol>
    <form action="{{ route('auth.logout') }}" method="GET">
        @csrf
        <button id="botonLogout" type="submit">Cerrar sesión</button>
    </form>
</body>
</html>