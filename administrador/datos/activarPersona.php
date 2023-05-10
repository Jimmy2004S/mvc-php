<?php 

if(isset($_POST['codigo'])){
    $codigo =  $_POST['codigo'];

    try{
        include("../../Datos/conexion.php");
        $sentencia = $conexion -> prepare ("UPDATE `persona` SET `estado`='Activo' WHERE codigo_persona =:codigo;");
        $sentencia -> bindParam(":codigo" , $codigo);
        $sentencia -> execute();
    
        if(!$sentencia){
            die('Fallido Activar');
        }
    
        echo 'Activado';
    }catch (Exception $e) {
        // Cancelar transacción en caso de error
        echo "Error al activar: " . $e->getMessage();
    }
  
}else{
    echo 'Codigo vacio';
}
