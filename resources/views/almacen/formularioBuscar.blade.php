<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <a href="{{ route('vistaAlmacen') }}">Volver al menú Almacen</a><br>
    @if (session('mensaje'))
        {{ session('mensaje') }}
    @endif
    <h2>Bienvenido a Buscar Almacen</h2>
    <form action="{{ route('buscarAlmacen') }}" method="post">
        @csrf
        <label for="id">Ingrese la id del almacen:</label>
        <input type="number" name="id" id="id" required>
        <button type="submit">Buscar</button>
    </form>
</body>
</html>