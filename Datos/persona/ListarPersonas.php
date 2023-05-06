<?php 
    include_once("../Datos/conexion.php");
    //LISTAR
    $sentenciaSQL = $conexion -> prepare("SELECT * FROM persona
    ");
    $sentenciaSQL -> execute();
    $listaPersonas = $sentenciaSQL -> fetchAll(PDO::FETCH_ASSOC);      
?>


