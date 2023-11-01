<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Camión</title>
</head>
<body>
    <a href="{{ route('home') }}">Volver al menú principal</a>
    <h1>Bienvenido a la view de camión</h1>
    <ol>
        <li><a href="{{ route('mostrarCamion') }}">Mostrar camiones</a></li>
        <li><a href="{{ route('vistaBuscarCamion') }}">Buscar camión y eliminar o editar el mismo</a></li>
        <li><a href="{{ route('crearCamion') }}">Crear camión</a></li>
        <li><a href="{{ route('formularioHora') }}">Asignar hora de llegada o salida de plataforma</a></li>
        <li><a href="{{ route('formularioAsignarPlataforma') }}">Asignar un camion a una plataforma</a></li>
        <li><a href="{{ route('asignarChofer') }}">Asigna un chofer a un camion</a></li>
    </ol>
</body>
</html>