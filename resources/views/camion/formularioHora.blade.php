<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <a href="{{ route('vistaCamion') }}">Volver al menu Camion</a>
    <h1>Registrar Hora de Llegada o Salida de Camión</h1> <br>
    @if (session('mensaje'))
        {{ session('mensaje') }}
        <br><br>
    @endif
    <form action="{{ route('marcarHora') }}" method="POST">
        @csrf
        <label for="matricula">Matrícula del Camión
            <input type="text" name="matricula" id="matricula">
        </label> <br><br>
        <label for="hora">Seleccionar Hora:
            <select name="hora" id="hora">
                <option value="llegada">Hora de Llegada</option>
                <option value="salida">Hora de Salida</option>
            </select> 
        </label><br><br>
        <button type="submit">Registrar Hora</button>
    </form>
</body>
</html>