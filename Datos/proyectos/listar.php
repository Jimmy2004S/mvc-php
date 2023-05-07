<?php 
    include("../Datos/conexion.php");
    //LISTAR
    $sentenciaSQL = $conexion -> prepare("SELECT * FROM proyectos");
    $sentenciaSQL -> execute();
    $lista = $sentenciaSQL -> fetchAll(PDO::FETCH_ASSOC);                 
?>