<?php 
include("../../Datos/conexion.php");


if(isset($_POST['codigo'])){
    $codigo =  $_POST['codigo'];
    try{
        $sentencia = $conexion -> prepare ("UPDATE `persona` SET `estado`='Inhabilitado' WHERE codigo_persona =:codigo;");
        $sentencia -> bindParam(":codigo" , $codigo);
        $sentencia -> execute();

        if(!$sentencia){
            die('Fallido Desactivar');
        }

        echo 'Desactivado';
    }catch (PDOException $e) {
        // Cancelar transacción en caso de error
        echo "Error al desactivar: " . $e->getMessage();
    }
    
}else{
    echo 'Codigo vacio';
}