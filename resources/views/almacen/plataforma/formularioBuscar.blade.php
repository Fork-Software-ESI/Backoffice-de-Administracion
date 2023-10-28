<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <a href="{{ route('vistaPlataforma') }}">Volver a Plataforma</a>
    <h2>Bienvenido a Buscar Plataforma</h2>
    <br><br>
    <form method="POST" action="{{ route('buscarPlataforma') }}">
        @csrf
        <label for="id">Id:</label>
        <input type="text" name="id" id="id" placeholder="Id de la plataforma">
        <br><br>
        <label for="estado">Estado:</label>
        <input type="text" name="estado" id="estado" placeholder="Estado de la plataforma">
        <br><br>
        <label for="almacen">Almacen:</label>
        <input type="text" name="almacen" id="almacen" placeholder="Almacen de la plataforma">
        <br><br>
        <button type="submit">Buscar Plataforma</button>
    </form>
</body>
</html>