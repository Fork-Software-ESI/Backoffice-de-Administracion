<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Almacen</title>
</head>
<body>
    <a href="{{ route('home') }}">Volver al menú principal</a>
    <h1>Bienvenido a la view de almacen</h1>
    <ol>
        <li><a href="{{ route('mostrarAlmacen') }}">Mostrar almacenes</a></li>
        <li><a href="{{ route('vistaBuscarAlmacen') }}">Buscar almacen y eliminar o editar el mismo</a></li>
        <li><a href="{{ route('crearAlmacen') }}">Crear almacen</a></li>
        <li><a href="{{ route('vistaPlataforma') }}">Plataforma</a></li>
    </ol>
</body>
</html>