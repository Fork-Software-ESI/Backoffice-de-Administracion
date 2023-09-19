<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estanterias - Crear estanteria</title>
</head>
<body>
    <a href="{{ route('vistaEstanteria') }}">Volver al menú de Estanteria</a>
    <h2>Bienvenido a editar estanteria</h2>
    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif
    <form action="{{ route('actualizarEstanteria', ['id' => $estanteria->id]) }}" method="post">
        @csrf
        @method('PATCH')
        <label for="almacen_id">Id de estanteria<input value="{{ $estanteria->almacen_id }}" type="number" name="almacen_id">
            @error('estanteria')
                <br>
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </label><br><br>
        <button type="submit">Actualizar estanteria</button>
    </form>
</body>
</html>