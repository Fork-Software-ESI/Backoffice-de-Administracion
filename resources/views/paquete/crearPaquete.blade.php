<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Paquete -  Crear Paquete</title>
    <style>
        #botonLogout {
            position: absolute;
            top: 0;
            right: 0;
        }
    </style>
</head>
<body>
    <a href="{{ route('vistaPaquete') }}">Volver al menú de Paquete</a><br>
    @if (session('mensaje'))
        <div class="mensaje-exito">
            {{ session('mensaje') }}
        </div>
    @endif
    <h1>Crear Paquete</h1>
    <form action="" method="post">
        @csrf
        <label for="Descripcion">Descripcion <input value="{{ old('Descripcion') }}" type="text" name="Descripcion" required>
            @error('Descripcion')
                <br>
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </label> <br> <br>
        <label for="Peso_Kg">Peso en kg <input value="{{ old('Peso_Kg') }}" type="text" name="Peso_Kg" required>
            @error('Peso_Kg')
                <br>
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </label><br><br>
        <label for="ID_Cliente">Id del cliente <input value="{{ old('ID_Cliente') }}" type="" name="ID_Cliente">
            @error('ID_Cliente')
                <br>
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </label><br><br>
        <label for="Calle">Calle <input value="{{ old('Calle') }}" type="" name="Calle">
            @error('Calle')
                <br>
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </label><br><br>
        <label for="Numero_Puerta">Numero de puerta <input value="{{ old('Numero_Puerta') }}" type="" name="Numero_Puerta">
            @error('Numero_Puerta')
                <br>
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </label><br><br>
        <label for="Ciudad">Ciudad <input value="{{ old('Ciudad') }}" type="" name="Ciudad">
            @error('Ciudad')
                <br>
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </label><br><br>
        <button type="submit">Crear</button>
    </form>
    <form action="{{ route('auth.logout') }}" method="GET">
        @csrf
        <button id="botonLogout" type="submit">Cerrar sesión</button>
    </form>
</body>
</html>