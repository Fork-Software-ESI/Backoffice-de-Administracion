<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chofer - Mostrar Usuarios</title>
</head>

<body>
    <a href="{{ route('vistaCamion') }}">Volver al menú Usuario</a>
    <h1>Asignar chofer a un camion</h1>
    @if (session('mensaje'))
        {{ session('mensaje') }} <br><br>
    @endif
    <form action="{{ route('asignarChofer') }}" method="POST">
        @csrf
        <label for="ID_Chofer">ID del chofer:
            <input type="number" name="ID_Chofer" value="{{ old('ID_Chofer') }}">
        </label> <br><br>
        <label for="ID_Camion">ID del camion:
            <input type="number" name="ID_Camion" value="{{ old('ID_Camion') }}">
        </label> <br><br>
        <label> Ingrese el estado en que se encuentra:
            <select name="estado">
                <option value="1">Estacionado</option>
                <option value="2">En plataforma</option>
                <option value="3">Cargado</option>
                <option value="4">En transito</option>
                <option value="5">Completado</option>
            </select>
        </label> <br><br>   
        <button type="submit">Asignar</button>
    </form>
</body>

</html>