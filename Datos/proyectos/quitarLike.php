<?php
session_start();
$codigoPersonaLogin = $_SESSION['codigo'];

try {
    include("../conexion.php");
    // Iniciar transacción
    $conexion->beginTransaction();
    $codigo_proyecto = $_POST['codigo'];

    // Crear registro del like en la tabla proyectos_likes
    $stmt = $conexion->prepare("DELETE FROM `proyectos_likes` WHERE proyecto_id =:codigo");
    $stmt->bindParam(":codigo", $codigo_proyecto);
    $stmt->execute();

    // Actualizar el número de likes en la tabla proyectos
    $stmt = $conexion->prepare("UPDATE proyectos SET likes = likes - 1 WHERE codigo = :codigo");
    $stmt->bindParam(":codigo", $codigo_proyecto);
    $stmt->execute();

    // Devolver respuesta al cliente
    echo "Quitar like";

    $conexion->commit();
} catch (Exception $e) {
    // Cancelar transacción en caso de error
    $conexion->rollback();
    echo "Error en la transacción: " . $e->getMessage();
} finally {
    $stmt = null;
    $conexion = null;
}
