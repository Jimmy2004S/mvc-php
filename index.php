
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/log.css">
</head>

<body>
    <form action="login.php" method="post">
        <h2>Login</h2>
        <p>Inicia sesión y administrar tus proyectos pendientes</p>
        <label for="email">Codigo</label>
        <input type="text" name="email" id="email">
        <label for="contrasenia">Contraseña</label>
        <input type="password" name="contrasenia" id="contrasenia">
        <button>Login</button>
        <hr>
        <p>¿No tienes una cuenta?<a href="register.php" target="_blank">Register</a></p>
    </form>

</body>

</html>