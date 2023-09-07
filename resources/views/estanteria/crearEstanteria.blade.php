<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Estanteria - Crear Estanteria</title>
</head>
<body>
    <a href="{{ route('vistaEstanteria') }}">Volver al menú Estanteria</a><br>
    @if (session('mensaje'))
        <div class="mensaje-exito">
            {{ session('mensaje') }}
        </div>
    @endif
    <h1>Crear estanteria</h1>
    <form action="" method="post">
        @csrf
        <label for="almacen_id">ID Almacen <input value="{{ old('almacen_id') }}" type="number" name="almacen_id" required>
            @error('almacen_id')
                <br>
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </label><br><br>
        <button type="submit">Crear</button>
    </form>
</body>
</html>