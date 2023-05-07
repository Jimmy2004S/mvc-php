<?php 
    try{
        $codigo = (isset($_POST["codigo"]))? $_POST["codigo"]: "";
        include("../Datos/conexion.php");
        $stmt = $conexion -> prepare("SELECT * FROM proyectos WHERE codigo=:codigo");
        $stmt ->bindParam(':codigo', $codigo, PDO::PARAM_INT);
        $stmt -> execute();
        $ProyectoXcodigo =  $stmt-> fetch(PDO::FETCH_ASSOC);

        $conexion = null;

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
?>