<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estanterias - Crear estanteria</title>
</head>
<body>
    <a href="{{ route('vistaEstante') }}">Volver al menú de Estanteria</a>
    <h2>Bienvenido a editar estanteria</h2>
    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif
    <form action="{{ route('actualizarEstante', ['id' => $estanteria->ID]) }}" method="post">
        @csrf
        @method('PATCH')
        <label for="ID_Almacen">ID Almacen: <input value="{{ $estanteria->ID_Almacen }}" type="number" name="ID_Almacen">
            @error('ID_Almacen')
                <br>
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </label><br><br>
        <button type="submit">Actualizar estanteria</button>
    </form>
</body>
</html>