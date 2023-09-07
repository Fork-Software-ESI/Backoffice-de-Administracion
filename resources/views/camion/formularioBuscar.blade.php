<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Camion - Buscar</title>
</head>
<body>
    <a href="{{ route('vistaCamion') }}">Volver al menú principal</a><br>
    @if (session('mensaje'))
        {{ session('mensaje') }}
    @endif
    <h2>Bienvenido a Buscar Camión</h2>
    <form action="{{ route('buscarCamion') }}" method="post">
        @csrf
        <label for="matricula">Ingrese la matricula del camion:</label>
        <input type="number" name="matricula" id="matricula" required>
        <button type="submit">Buscar</button>
    </form>
</body>
</html>