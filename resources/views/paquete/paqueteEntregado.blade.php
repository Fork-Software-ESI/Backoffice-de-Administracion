<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <a href="{{ route('vistaPaquete') }}">Volver a la vista Paquete</a>
    <h1>Marcar paquete entregado</h1>
    @if (session('mensaje'))
        {{ session('mensaje') }}
    @endif
    <form action="{{ route('paqueteEntregado') }}" method="post">
        @csrf
        <label for="ID_Paquete">ID del paquete
            <input type="text" name="ID_Paquete">
        </label>
        <input type="submit" value="Marcar como entregado">
    </form>
</body>
</html>