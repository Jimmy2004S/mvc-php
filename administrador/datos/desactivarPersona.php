<?php 
include("../../Datos/conexion.php");

if(isset($_POST['codigo'])){
    $codigo =  $_POST['codigo'];

    $sentencia = $conexion -> prepare ("UPDATE `persona` SET `estado`='Inactivo' WHERE codigo =:codigo;");
    $sentencia -> bindParam(":codigo" , $codigo);
    $sentencia -> execute();

    if(!$sentencia){
        die('Fallido Desactivar');
    }

    echo 'Activado';
}