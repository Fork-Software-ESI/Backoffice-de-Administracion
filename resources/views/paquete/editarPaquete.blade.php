<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Paquete - Editar Paquete</title>
</head>
<body>
    <a href="{{ route('vistaPaquete') }}">Volver al menú de Paquete</a><br>
    <h1>Editar Paquete</h1>
    <form action="{{ route('actualizarPaquete', ['id' => $paquete->id]) }}" method="post">
        @csrf
        @method('PATCH')
        <label for="descripcion">Descripcion <input value="{{ $paquete->descripcion }}" type="text" name="descripcion">
            @error('descripcion')
                <br>
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </label><br><br>
        <label for="peso_kg">Peso en kg <input value="{{ $paquete->peso_kg }}" type="text" name="peso_kg">
            @error('peso_kg')
                <br>
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </label><br><br>
        <label for="lote_id">Id del lote <input value="{{ $paquete->lote_id }}" type="text" name="lote_id">
            @error('lote_id')
                <br>
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </label><br><br>
        <button type="submit">Actualizar Paquete</button>
    </form>
</body>
</html>