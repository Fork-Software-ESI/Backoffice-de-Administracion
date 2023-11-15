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
    <form action="{{ route('actualizarPaquete', ['id' => $paquete->ID]) }}" method="post">
        @csrf
        @method('PATCH')
        <label for="descripcion">Descripcion <input value="{{ $paquete->Descripcion }}" type="text" name="descripcion">
            @error('descripcion')
                <br>
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </label> <br> <br>
        <label for="peso_Kg">Peso en kg <input value="{{ $paquete->Peso_Kg }}" type="text" name="peso_Kg">
            @error('peso_Kg')
                <br>
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </label><br><br>
        <label for="ID_Cliente">Id del cliente <input value="{{ $paquete->ID_Cliente }}" type="" name="ID_Cliente">
            @error('ID_Cliente')
                <br>
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </label><br><br>
        <label for="ID_Estado">Estado 
            <select name="ID_Estado">
                <option value="1" {{ $paquete->ID_Estado == '1' ? 'selected' : '' }}>En almacen</option>
                <option value="2" {{ $paquete->ID_Estado == '2' ? 'selected' : '' }}>En transito</option>
                <option value="3" {{ $paquete->ID_Estado == '3' ? 'selected' : '' }}>Entregado</option>
            </select>
        </label><br><br>
        <label for="destino">Destino <input value="{{ $paquete->Destino }}" type="" name="destino">
            @error('destino')
                <br>
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </label><br><br>
        <button type="submit">Actualizar Paquete</button>
    </form>
    <form action="{{ route('auth.logout') }}" method="GET">
        @csrf
        <button id="botonLogout" type="submit">Cerrar sesión</button>
    </form>
</body>

</html>
