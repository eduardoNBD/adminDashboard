<!DOCTYPE html>
<html>
<head>
    <title>Restablecimiento de Contraseña</title>
</head>
<body>
    <p>Haga clic en el siguiente enlace para restablecer su contraseña:</p>
    <a href="{{ url('password-reset', $token) }}">Restablecer Contraseña</a>
</body>
</html>