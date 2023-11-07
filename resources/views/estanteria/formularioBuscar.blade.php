<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="{{ route('vistaEstante') }}">Volver al menú de Estanteria</a><br>
    @if (session('mensaje'))
        {{ session('mensaje') }}
    @endif
    <h2>Bienvenido a Buscar Estante</h2>
    <form action="{{ route('buscarEstante') }}" method="post">
        @csrf
        <label for="ID">Ingrese la id del estanteria:</label>
        <input type="number" name="ID" required>
        <button type="submit">Buscar</button>
    </form>
</body>
</html>