<?php
session_start();

$conex = mysqli_connect("localhost", "root", "", "proyectosi");

if($conex){
    echo "si";
}else{
    echo "error";
}

$identificacion = $_POST['email'];
$clave = $_POST['contrasenia'];

$consulta = "SELECT * FROM persona WHERE identificacion='$identificacion' and clave= '$clave'";
$resultado = mysqli_query($conex, $consulta);

$personas = mysqli_fetch_array($resultado);

if($resultado != null){
    $_SESSION['codigo'] = $personas['codigo'];
    $_SESSION['identificacion'] = $personas['identificacion'];
    $_SESSION['nombre'] = $personas['nombre'];
    $_SESSION['apellido'] = $personas['apellido'];
    $_SESSION['email'] = $personas['email'];
    if($personas['tipo_persona'] == 'Administrador'){
        header("location:vistas/inicio.php");
    }elseif($personas['tipo_persona'] == 'Estudiante'){
        header("location:vistas/inicio.php");
    }
}


mysqli_free_result($resultado);
mysqli_close($conex);


?>