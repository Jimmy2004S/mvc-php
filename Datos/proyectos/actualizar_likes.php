<?php
// 1. Conectarse a la base de datos
include_once("../Datos/conexion.php");

// 2. Verificar si se ha enviado la acción de Like
if (isset($_POST['accion']) && $_POST['accion'] == 'Like') {
    // 3. Recuperar el proyecto ID enviado desde el cliente
    $proyecto_id = $_POST['codigo'];

    // 4. Obtener los likes actuales del proyecto desde la base de datos
    $sql = "SELECT likes FROM proyectos WHERE codigo = '$proyecto_id'";
    $sentenciaSQL = $conexion->prepare($sql);
    $sentenciaSQL->execute();
    $lista = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
    $likes_actuales = $lista[0]['likes'];

    // 5. Actualizar los likes del proyecto en la base de datos
    $nuevo_numero_de_likes = $likes_actuales + 1;
    $sentencia = $conexion->prepare("UPDATE proyectos SET likes=:likes WHERE codigo=:codigo");
    $sentencia->bindParam(":likes", $nuevo_numero_de_likes);
    $sentencia->bindParam(":codigo", $proyecto_id);
    $sentencia->execute();

    // 6. Volver a cargar la página para que se muestren los nuevos likes
    header("Location: ../vistas/inicio.php#proyecto_$proyecto_id");
}

// 7. Cerrar la conexión a la base de datos
$conexion = null;
?>

