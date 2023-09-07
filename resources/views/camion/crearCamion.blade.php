<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Camion - Crear Camion</title>
</head>
<body>
    <a href="{{ route('vistaCamion') }}">Volver al menú de Camión</a>
    @if (session('mensaje'))
        <div class="mensaje-exito">
            {{ session('mensaje') }}
        </div>
    @endif
    <h1>Crear Camión</h1>
    <form action="" method="post">
        @csrf
        <label for="matricula">Matricula <input value="{{ old('matricula') }}" type="text" name="matricula" required>
            @error('matricula')
                <br>
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </label><br><br>
        <label for="pesoMaximoKg">Capacidad <input value="{{ old('pesoMaximoKg') }}" type="text" name="pesoMaximoKg" required>
            @error('pesoMaximoKg')
                <br>
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </label><br><br>
        <button type="submit">Crear</button>
    </form>
</body>
</html>