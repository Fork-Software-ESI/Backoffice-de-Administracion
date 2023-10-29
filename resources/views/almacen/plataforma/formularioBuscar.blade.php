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
        <label for="numero">Numero</label>
        <input type="number" name="numero" id="numero" required>
        <br><br>
        <button type="submit">Buscar Plataforma</button>
    </form>
</body>
</html>