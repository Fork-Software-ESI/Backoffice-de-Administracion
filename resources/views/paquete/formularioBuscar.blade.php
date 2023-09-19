<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <a href="{{ route('vistaPaquete') }}">Volver al menú de Paquete</a><br>
    @if (session('mensaje'))
        {{ session('mensaje') }}
    @endif
    <h2>Bienvenido a Buscar Paquete</h2>
    <form action="{{ route('buscarPaquete') }}" method="post">
        @csrf
        <label for="id">Ingrese la id del Paquete:</label>
        <input type="number" name="id" id="id" required>
        <button type="submit">Buscar</button>
    </form>
</body>
</html>