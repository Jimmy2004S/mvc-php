<?php 
include("../../Datos/conexion.php");

if(isset($_POST['codigo'])){
    $codigo =  $_POST['codigo'];

    $sentencia = $conexion -> prepare ("UPDATE `persona` SET `estado`='Activo' WHERE codigo =:codigo;");
    $sentencia -> bindParam(":codigo" , $codigo);
    $sentencia -> execute();

    if(!$sentencia){
        die('Fallido Activar');
    }

    echo 'Activado';
}
