<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lote - Editar Lote</title>
</head>
<body>
    <a href="{{ route('vistaLote') }}">Volver al menú Usuario</a>
    <h2>Bienvenido a Editar Lote</h2>
    <form action="{{ route('actualizarLote', ['id' => $lote->id]) }}" method="post">
        @csrf
        @method('PATCH')
        <label for="descripcion">Descripcion <input value="{{ $lote->Descripcion }}" type="text" name="descripcion">
            @error('descripcion')
                <br>
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </label><br><br>
        <label for="peso_kg">Peso_Kg <input value="{{ $lote->Peso_Kg }}" type="text" name="peso_kg">
            @error('peso_kg')
                <br>
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </label><br><br>
        <button type="submit">Actualizar lote</button>
    </form>
</body>
</html>