<?php
session_start();
$codigoPersonaLogin = $_SESSION['codigo'];


try{
        include("../conexion.php");
        $stmt = $conexion -> prepare("SELECT * FROM proyectos WHERE codigo_lider_proyecto=:codigo");
        $stmt ->bindParam(':codigo', $codigoPersonaLogin, PDO::PARAM_INT);
        $stmt -> execute();
        $proyectoXpersona = $stmt -> fetchAll(PDO::FETCH_ASSOC);   

        $json = array();
        foreach ($proyectoXpersona as $row) {
          $json[] = array(
            'codigo' => $row['codigo'],
            'nombre' => $row['nombre'],
            'descripcion' => $row['descripcion'],
            'fecha_inicio' => $row['fecha_inicio'],
            'likes' => $row['likes'],
            'archivo' => $row['archivo'],
            'codigoGrupo' => $row['codigo_grupo']
          );
        }
          // Convertir a JSON y enviar respuesta al cliente
        $jsonstring = json_encode($json);
        echo $jsonstring;

        $conexion = null;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
?>