<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <a href="../almacen.blade.php">Volver al aparatado de Almacen</a><br>
    <h2>Bienvenido a Buscar Plataforma</h2>
    <ol>
        <li><a href="{{ route('mostrarPlataforma') }}">Ver Plataformas</a></li>
        <li><a href="{{ route('crearPlataforma') }}">Crear Plataforma</a></li>
        <li><a href="{{ route('buscarPlataforma') }}">Buscar Plataforma</a></li>
    </ol>
</body>
</html>