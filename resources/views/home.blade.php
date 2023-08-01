<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
</head>
<body>
    <h1>Bienvenidos a Fork Software</h1>
    <ol>
        <li><a href="{{ route('user.mostrarVistaPrincipal') }}">Usuarios</a></li>
        <li><a href="{{ route('almacen.mostrarVistaPrincipalAlmacen') }}">Almacenes</a></li>
        <li><a href="{{ route('paquete.mostrarVistaPrincipalPaquete') }}">Paquetes</a></li>
        <li><a href="{{ route('lote.mostrarVistaPrincipalLote') }}">Lotes</a></li>
        <li><a href="{{ route('estanteria.mostrarVistaPrincipalEstanteria') }}">Estanterias</a></li>
    </ol>
</body>
</html>