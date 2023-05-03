<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/register.css">
</head>
<body>
    <form action="" method="post">
        <h2>Register</h2>
        <p>Crea una <span>cuenta</span> para acceder a las funciones de la aplicación</p>
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" placeholder="Juan" required>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="juan@gmail.com" required>
        <label for="contra">Contraseña</label>
        <input type="password" name="contra" id="con" required>
        <label for="confcon">Confirmar Contraseña</label>
        <input type="password" name="" id="confcon" required>
        <label for="tipous">Tipo de usuario</label>
        <select name="tipoUsuario" id="tipous">
            <option selected="true" disabled="disabled">seleccione tipo de usuario</option>
            <option value="administrador">Administrador</option>
            <option value="empleado">Empleado</option>
        </select>
        <button id="reg-btn">Registrarse</button>
        <p>¿Ya tienes una cuenta? <a href="index.php">Iniciar sesion</a></p>
    </form>
</body>
</html>