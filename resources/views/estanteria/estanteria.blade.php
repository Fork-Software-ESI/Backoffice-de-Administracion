<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>bienvenido a la view de estanterias</h1>
    <ol>
        <li><a href="{{ route('estanteria.mostrarEstanterias') }}">Mostrar estanterias</a></li>
        <li><a href="{{ route('estanteria.buscarEstanteria') }}">Buscar estanteria y eliminar o editar la misma</a></li>
        <li><a href="{{ route('estanteria.crearEstanteria') }}">Crear estanteria</a></li>
    </ol>
</body>
</html>