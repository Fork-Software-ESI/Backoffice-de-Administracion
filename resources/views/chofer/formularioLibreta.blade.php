<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Libreta Chofer</title>
</head>
<body>
    <h1>Ingrese el Tipo de libreta</h1>
    <form action="{{ route('guardarLibreta') }}" method="post">
        @csrf
        <label for="tipo_libreta"> Tipo de Libreta: 
            <input type="text" name="tipo_libreta" required>
        </label>
        <br>
        <input type="submit" value="Guardar">
    </form>
</body>
</html>