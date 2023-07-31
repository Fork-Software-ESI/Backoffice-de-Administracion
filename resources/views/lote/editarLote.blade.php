<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar Lote</title>
</head>
<body>
    <h2>Bienvenido a Editar Lote</h2>
    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif
    <form action="{{ route('lote.editarLote', ['descripcion' => $lote->descripcion]) }}" method="post">
        @csrf
        @method('PATCH')
        <label for="descripcion">Descripcion <input value="{{ $lote->descripcion }}" type="text" name="descripcion">
            @error('descripcion')
                <br>
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </label><br><br>
        <button type="submit">Actualizar lote</button>
</body>
</html>