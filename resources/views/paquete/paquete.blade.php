<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Paquete</title>
</head>
<body>
    <a href="{{ route('home') }}">Volver al menú principal</a>
    <h2>Bienvenido a la view de Paquete</h2>    
    <ol>
        <li><a href="{{ route('mostrarPaquete') }}">Mostrar paquetes</a></li>
        <li><a href="{{ route('vistaBuscarPaquete') }}">Buscar paquete y eliminarlo o editarlo</a></li>
        <li><a href="{{ route('crearPaquete') }}">Crear paquete</a></li>
        <li><a href="{{ route('vistaAsignarLote') }}">Asignar paquete a lote</a></li>
    </ol>
</body>
</html>