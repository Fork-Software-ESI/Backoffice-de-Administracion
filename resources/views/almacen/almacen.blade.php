<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Almacen</title>
</head>
<body>
    <h1>Bienvenido a la view de almacen</h1>
    <ol>
        <li><a href="{{ route('almacen.mostrarAlmacenes') }}">Mostrar almacenes</a></li>
        <li><a href="{{ route('almacen.buscarAlmacen') }}">Buscar almacen y eliminar o editar el mismo</a></li>
        <li><a href="{{ route('almacen.crearAlmacen') }}">Crear almacen</a></li>
    </ol>
</body>
</html>