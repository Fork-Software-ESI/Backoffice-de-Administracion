<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lote</title>
</head>
<body>
    <h1>Bienvenido a la view de Lote</h1>
    <ol>
        <li><a href="{{ route('mostrarLotes') }}">Mostrar Lotes</a></li>
        <li><a href="{{ route('vistaBuscarLote') }}">Buscar Lote y eliminarlo o editarlo</a></li>
        <li><a href="{{ route('crearLote') }}">Crear Lote</a></li>
    </ol>
</body>
</html>