<?php
$codigoPersonaLogin = $_SESSION['codigo'];

try{
        $codigo = (isset($_POST["codigo"]))? $_POST["codigo"]: "";
        include("../Datos/conexion.php");
        $stmt = $conexion -> prepare("SELECT * FROM proyectos WHERE codigo_lider_proyecto=20222");
        $stmt -> execute();
        $proyectoXpersona = $stmt -> fetchAll(PDO::FETCH_ASSOC);   

        $conexion = null;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
?>