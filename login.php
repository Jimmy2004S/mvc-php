<?php

$conex = mysqli_connect("localhost", "root", "", "proyectosi");

if($conex){
    echo "si";
}else{
    echo "error";
}

$email = $_POST['email'];
$clave = $_POST['contrasenia'];

$consulta = "SELECT * FROM persona WHERE identificacion='$email' and clave= '$clave'";
$resultado = mysqli_query($conex, $consulta);

$filas = mysqli_fetch_array($resultado);

if($filas != null){
    if($filas['tipo_persona'] == 'Administrador'){
        header("location:vistas/inicio.php");
    }elseif($filas['tipo_persona'] == 'Estudiante'){
        header("location:vistas/inicio.php");
        loginUsuario();
    }
}


mysqli_free_result($resultado);
mysqli_close($conex);


?>