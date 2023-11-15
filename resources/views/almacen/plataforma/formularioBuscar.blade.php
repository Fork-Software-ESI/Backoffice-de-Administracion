<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        #botonLogout {
            position: absolute;
            top: 0;
            right: 0;
        }
    </style>
</head>
<body>
    <a href="{{ route('vistaPlataforma') }}">Volver a Plataforma</a> <br>
    @if (session('mensaje'))
            {{ session('mensaje') }}
        </div>
    @endif
    <h2>Bienvenido a Buscar Plataforma</h2>
    <br><br>
    <form method="POST" action="{{ route('buscarPlataforma') }}">
        @csrf
        <label for="numero">Numero</label>
        <input type="number" name="numero" id="numero" required>
        <br><br>
        <button type="submit">Buscar Plataforma</button>
    </form>
    <form action="{{ route('auth.logout') }}" method="GET">
        @csrf
        <button id="botonLogout" type="submit">Cerrar sesión</button>
    </form>
</body>
</html>