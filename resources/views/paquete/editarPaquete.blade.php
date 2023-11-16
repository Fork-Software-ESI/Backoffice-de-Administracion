<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Paquete - Editar Paquete</title>
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
    <h1>Editar Paquete</h1>
    <form action="{{ route('actualizarPaquete', ['id' => $datos['ID']]) }}" method="post">
        @csrf
        @method('PATCH')
        <label for="Descripcion">Descripcion <input value="{{ $datos['Descripcion'] }}" type="text"
                name="Descripcion">
            @error('Descripcion')
                <br>
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </label> <br> <br>
        <label for="Peso_Kg">Peso en kg <input value="{{ $datos['Peso_Kg'] }}" type="text" name="Peso_Kg">
            @error('Peso_Kg')
                <br>
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </label><br><br>
        <label for="ID_Cliente">Id del cliente <input value="{{ $datos['ID_Cliente'] }}" type=""
                name="ID_Cliente">
            @error('ID_Cliente')
                <br>
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </label><br><br>
        <label for="ID_Estado">Estado
            <select name="ID_Estado">
                <option value="1" {{ $datos['ID_Estado'] == '1' ? 'selected' : '' }}>En almacen</option>
                <option value="2" {{ $datos['ID_Estado'] == '2' ? 'selected' : '' }}>En lote</option>
                <option value="3" {{ $datos['ID_Estado'] == '3' ? 'selected' : '' }}>En transito</option>
                <option value="4" {{ $datos['ID_Estado'] == '4' ? 'selected' : '' }}>Entregado</option>'
            </select>
        </label><br><br>
        <button type="submit">Actualizar Paquete</button>
    </form>
    <form action="{{ route('auth.logout') }}" method="GET">
        @csrf
        <button id="botonLogout" type="submit">Cerrar sesión</button>
    </form>
</body>

</html>
