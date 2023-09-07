<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="{{ route('vistaEstanteria') }}">Volver al menú Estanteria</a><br>
    @if (session('mensaje'))
        {{ session('mensaje') }}
    @endif
    <h2>Bienvenido a Buscar Estanteria</h2>
    <form action="{{ route('buscarEstanteria') }}" method="post">
        @csrf
        <label for="id">Ingrese la id del estanteria:</label>
        <input type="number" name="id" id="id" required>
        <button type="submit">Buscar</button>
    </form>
</body>
</html>