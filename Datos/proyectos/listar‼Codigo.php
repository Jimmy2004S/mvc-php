<?php 
    try{
        $codigo = (isset($_POST["codigo"]))? $_POST["codigo"]: "";
        include("../conexion.php");
        $stmt = $conexion -> prepare("SELECT * FROM proyectos WHERE codigo=:codigo");
        $stmt ->bindParam(':codigo', $codigo, PDO::PARAM_INT);
        $stmt -> execute();
        $proyectoXpersona =  $stmt-> fetch(PDO::FETCH_ASSOC);

        // Convertir a JSON y enviar respuesta al cliente
        echo json_encode($proyectoXpersona);

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
?>