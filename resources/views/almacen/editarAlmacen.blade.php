<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Almacen - Editar Almacen</title>
    <style>
        #botonLogout {
            position: absolute;
            top: 0;
            right: 0;
        }
    </style>
</head>
<body>
    <a href="{{ route('vistaAlmacen') }}">Volver al menú Almacen</a>
    <h2>Bienvenido a editar almacen</h2>
    <form action="{{ route('actualizarAlmacen', ['id' => $almacen->ID]) }}" method="post">
        @csrf
        @method('PATCH')
        <label for="Direccion">Direccion <input value="{{ $almacen->Direccion }}" type="text" name="Direccion">
            @error('Direccion')
                <br>
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </label><br><br>
        <button type="submit">Actualizar Almacen</button>
    </form>
    <form action="{{ route('auth.logout') }}" method="GET">
        @csrf
        <button id="botonLogout" type="submit">Cerrar sesión</button>
    </form>
</body>
</html>