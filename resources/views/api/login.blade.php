<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicio de sesión</title>
    <style>
        body {
            backgroundrgb(255, 255, 255) #1a1a1a;
            color: #000000;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        form {
            width: 50%;
            margin: 0;
            padding: 20px;
            border-radius: 8px;
        }

        .mensaje-error {
            background-color: #ff0000;
            color: #ffffff;
            padding: 10px;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    @if (session('mensaje'))
        <div class="mensaje-error">
            {{ session('mensaje') }}
        </div>
    @endif
    <form action="" method="post">
        @csrf
        <label for="username">Nombre de usuario <input type="text" name="username" value="{{ old('username') }}"
                required>
            @error('username')
                <br>
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </label><br><br>
        <label for="password">Contraseña <input type="password" name="password" required>
            @error('password')
                <br>
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </label>
        <br><br>
        <input type="submit" value="Iniciar sesión"><br>
    </form>

</body>

</html>
