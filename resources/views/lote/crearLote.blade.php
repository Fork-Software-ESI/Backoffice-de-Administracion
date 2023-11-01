<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lote - Crear Lote</title>
</head>
<body>
<a href="{{ route('vistaLote') }}">Volver al menú Lote</a>
    @if (session('mensaje'))
        <div class="mensaje-exito">
            {{ session('mensaje') }}
        </div>
    @endif
    <h1>Crear lote</h1>
    <form action="" method="post">
        @csrf
        <label for="descripcion">Descripcion <input value="{{ old('descripcion') }}" type="text" name="descripcion" required>
            @error('descripcion')
                <br>
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </label><br><br>
        <label for="peso_kg">Peso_Kg <input value="{{ old('peso_kg') }}" type="text" name="peso_kg" required>
            @error('peso_kg')
                <br>
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </label><br><br>
        <button type="submit">Crear</button>
    </form>
</body>
</html>