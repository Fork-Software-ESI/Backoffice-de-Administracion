<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Estanteria - Crear Estante</title>
</head>
<body>
    <a href="{{ route('vistaEstante') }}">Volver al menú de Estante</a><br>
    @if (session('mensaje'))
        {{ session('mensaje') }}
    @endif
    <h1>Crear estanteria</h1>
    <form action="" method="post">
        @csrf
        <label for="ID_Almacen">ID Almacen <input value="{{ old('ID_Almacen') }}" type="number" name="ID_Almacen" required>
            @error('ID_Almacen')
                <br>
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </label><br><br>
        <button type="submit">Crear</button>
    </form>
</body>
</html>