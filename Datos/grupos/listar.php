<?php 
    include_once("../Datos/conexion.php");
    //LISTAR
    $sentenciaSQL = $conexion -> prepare("SELECT * FROM grupo");
    $sentenciaSQL -> execute();
    $listaCodigoGrupo = $sentenciaSQL -> fetchAll(PDO::FETCH_ASSOC);                 
?>