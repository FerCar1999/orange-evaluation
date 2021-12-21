<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recuperando Clave</title>
</head>

<body>
    <h4>Estimado {{ $recovery['name'] }} ingrese al siguiente enlace para recuperar su contraseña</h4>
    <a href="http://127.0.0.1:8000/recovery-password/{{ $recovery['token'] }}">Haz click aqui</a>
</body>

</html>
