<?php
// 1. Conectarse a la base de datos
include("../conexion.php");

try{
            // 3. Recuperar el proyecto ID enviado desde el cliente
            $proyecto_id = $_POST['codigo'];

            // 4. Obtener los likes actuales del proyecto desde la base de datos
            $sql = "SELECT likes FROM proyectos WHERE codigo =:codigo";
            $sentenciaSQL = $conexion->prepare($sql);
            $sentenciaSQL ->bindParam(":codigo", $proyecto_id);
            $sentenciaSQL->execute();
            $lista = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
            $likes_actuales = $lista[0]['likes'];

            // 5. Actualizar los likes del proyecto en la base de datos
            $nuevo_numero_de_likes = $likes_actuales + 1;
            $sentencia = $conexion->prepare("UPDATE proyectos SET likes=:likes WHERE codigo=:codigo");
            $sentencia->bindParam(":likes", $nuevo_numero_de_likes);
            $sentencia->bindParam(":codigo", $proyecto_id);
            $sentencia->execute();

            // 6. Convertimos a formato json
            $response = array('likes' => $nuevo_numero_de_likes);
            echo json_encode($response);

        // 7. Cerrar la conexión a la base de datos
        $conexion = null;
    } catch (PDOException $e) {
        echo "Error en la transacción: " . $e->getMessage();
    }
?>
