<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
</head>

<body>
    @if (auth()->check())
        <h1>Bienvenido {{ auth()->user()->nombre }}</h1>
        <h2>Indice</h2>
        <ul>
            <li>Lista de Almacenes</li>
            <li>Gestión de Almacenes</li>
            <li>Lista de Paquetes</li>
            <li>Gestión de Paquetes</li>
            <li>Lista de Lotes</li>
            <li>Gestión de Lotes</li>
        </ul>
    @else
        <p>Debes iniciar sesión para acceder a esta página.</p>
    @endif

</body>

</html>
