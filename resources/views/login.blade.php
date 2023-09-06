<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Iniciar sesión</title>
    <style>
        .container {
            height: 225px;
            border: 2px black solid;
            box-shadow: 15px 15px 20px rgba(0, 0, 0, 0.5);
            width: 30%;
            margin: 0 auto;
            margin-top: 17%;
            text-align: center;
        }
    </style>
</head>

<body>
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

    <div class="container">
    <form action="{{ route('auth.login') }}" method="POST">
        @csrf
        <legend><h1>Iniciar sesión</h1></legend>
        <label for="username">Nombre de usuario</label>
        <input type="text" name="username"><br><br>
        <label for="password">Contraseña</label>
        <input type="password" name="password"><br><br>
        <input type="submit" value="Iniciar sesión">
    </form>
    </div>
</body>

</html>
