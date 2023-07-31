<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @if (session('mensaje'))
        <div class="mensaje-exito">
            {{ session('mensaje') }}
        </div>
    @endif
    <h1>Crear usuario</h1>
    <form action="" method="post">
        @csrf
        <label for="direccion">Direccion <input value="{{ old('direccion') }}" type="text" name="direccion" required>
            @error('direccion')
                <br>
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </label><br><br>
        <button type="submit">Crear</button>
    </form>
</body>
</html>