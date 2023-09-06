<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Almacen - Editar Almacen</title>
</head>
<body>
    <a href="{{ route('vistaAlmacen') }}">Volver al menú Usuario</a>
    <h2>Bienvenido a editar almacen</h2>
    <form action="{{ route('actualizarAlmacen', ['id' => $almacen->id]) }}" method="post">
        @csrf
        @method('PATCH')
        <label for="direccion">direccion <input value="{{ $almacen->direccion }}" type="text" name="direccion">
            @error('direccion')
                <br>
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </label><br><br>
        <button type="submit">Actualizar Almacen</button>
    </form>
</body>
</html>