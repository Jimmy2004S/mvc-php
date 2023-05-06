<?php 
    include_once("../Datos/conexion.php");

    $codigo = (isset($_POST["codigo"]))? $_POST["codigo"]: "";

    $sentenciaSQL = $conexion -> prepare("SELECT * FROM proyectos WHERE codigo=:codigo");
    $sentencia ->bindParam(':codigo', $codigo, PDO::PARAM_INT);
    $sentencia -> execute();
    $ProyectoXcodigo =  $sentencia-> fetch(PDO::FETCH_ASSOC);

?>