<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crear Plataforma</title>
    <style>
        #botonLogout {
            position: absolute;
            top: 0;
            right: 0;
        }
    </style>
</head>
<body>
    
    <a href="{{ route('vistaPlataforma') }}">Volver al menú de Plataforma</a>
    <br><br>
    @if (session('mensaje'))
            {{ session('mensaje') }}
        </div>
    @endif
    <h2>Bienvenido a Crear Plataforma</h2>
    <form method="POST" action="{{ route('crearPlataforma') }}">
        @csrf
        <label for="numero">Numero:
            <input type="text" name="numero" id="numero" required>
        </label> <br><br>
        <label for="ID_Almacen">ID Almacen
            <input type="text" name="ID_Almacen" id="ID_Almacen" required>
        </label> <br><br>
        <input type="submit" placeholder="Crear">
    </form>
    <form action="{{ route('auth.logout') }}" method="GET">
        @csrf
        <button id="botonLogout" type="submit">Cerrar sesión</button>
    </form>
</body>
</html>