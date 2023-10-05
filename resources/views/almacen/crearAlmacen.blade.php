<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Almacen - Crear Almacen</title>
</head>
<body>
    <a href="{{ route('vistaAlmacen') }}">Volver al menú Almacen</a>
    @if (session('mensaje'))
        <div class="mensaje-exito">
            {{ session('mensaje') }}
        </div>
    @endif
    <h1>Crear Almacen</h1>
    <form action="" method="post">
        @csrf
        <label for="Direccion">Direccion <input value="{{ old('Direccion') }}" type="text" name="Direccion" required>
            @error('Direccion')
                <br>
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </label><br><br>
        <button type="submit">Crear</button>
    </form>
</body>
</html>