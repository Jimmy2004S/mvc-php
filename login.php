<?php
session_start();


$conex = mysqli_connect("localhost", "root", "", "proyectosi");

$identificacion = $_POST['identificacion'];
$clave = $_POST['contrasenia'];

$consulta = "SELECT * FROM persona WHERE identificacion='$identificacion' and clave= '$clave'";
$resultado = mysqli_query($conex, $consulta);

$personas = mysqli_fetch_array($resultado);

if($personas != null){
    if($personas['estado'] == 'Activo'){
        $_SESSION['codigo'] = $personas['codigo'];
        $_SESSION['identificacion'] = $personas['identificacion'];
        $_SESSION['nombre'] = $personas['nombre'];
        $_SESSION['apellido'] = $personas['apellido'];
        $_SESSION['email'] = $personas['email'];
        $_SESSION['tipo_persona'] = $personas['tipo_persona'];
        if($personas['tipo_persona'] == 'Administrador'){
            header("location:administrador/inicioAdmin.php");
        }elseif($personas['tipo_persona'] == 'Estudiante' || $personas['tipo_persona'] == 'Profesor'){
            header("location:vistas/inicio.php");
        }
    }else{
        echo '<script>window.alert("Su cuenta esta inactiva..."); window.location.href ="index.php";</script>';
    }
}else{
    $_SESSION['error_login'] = true;
    header("location:/index.php");
}


mysqli_free_result($resultado);
mysqli_close($conex);


?>