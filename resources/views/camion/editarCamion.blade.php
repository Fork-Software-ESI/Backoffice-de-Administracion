<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Camión - Editar Camión</title>
    <style>
        #botonLogout {
            position: absolute;
            top: 0;
            right: 0;
        }
    </style>
</head>
<body>
    <a href="{{ route('vistaAlmacen') }}">Volver al menú Camión</a>
    <h2>Bienvenido a editar camión</h2>
    <form action="{{ route('actualizarCamion', ['matricula' => $camion->Matricula]) }}" method="post">
        @csrf
        @method('PATCH')
        <label for="matricula">matricula <input value="{{ $camion->Matricula }}" type="text" name="matricula">
            @error('matricula')
                <br>
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </label><br><br>
        <label for="pesoMaximoKg">peso máximo kg <input value="{{ $camion->PesoMaximoKg }}" type="text" name="pesoMaximoKg">
            @error('pesoMaximoKg')
                <br>
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </label><br><br>
        <button type="submit">Actualizar Camión</button>
    </form>
    <form action="{{ route('auth.logout') }}" method="GET">
        @csrf
        <button id="botonLogout" type="submit">Cerrar sesión</button>
    </form>
</body>
</html>