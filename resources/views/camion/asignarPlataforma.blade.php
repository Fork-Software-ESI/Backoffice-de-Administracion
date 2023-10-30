<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <a href="{{ route('vistaCamion') }}">Voler a menu camion</a><br>
    @if (session('mensaje'))
        {{ session('mensaje') }}
        <br><br>
    @endif
    <h1>Asignar plataforma</h1>
    <form action="{{ route('asignarPlataforma') }}" method="POST">
        @csrf
        <label for="matricula">Matricula:
            <input type="text" name="matricula" id="matricula" required>
        </label>
        <br><br>
        <label for="numero_plataforma">Numero plataforma:
            <input type="number" name="numero_plataforma" id="numero_plataforma" required>
        </label>
        <br><br>
        <input type="submit" value="Asignar">
    </form>
</body>
</html>