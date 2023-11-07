<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Asignar Paquete a Lote</title>
</head>
<body>
    <a href="{{ route('vistaPaquete') }}">Volver para atras</a><br>
    @if (session('mensaje'))
        {{ session('mensaje') }}
    @endif
    <h1>Asignar Paquete a Lote</h1>
    <form action="{{ route('asignarLote') }}" method="post">
        @csrf
        <label for="ID_Paquete">Paquete: <input type="number" name="ID_Paquete"></label>
        <br><br>
        <label for="ID_Lote">Lote: <input type="number" name="ID_Lote"></label>
        <br><br>
        <input type="submit" value="Asignar">
    </form>
</body>
</html>