<?php
include("../Datos/conexion.php");

$fecha = new DateTime();
try {

    // Preparar la consulta SQL
    $stmt = $conexion->prepare("INSERT INTO `proyectos`(`nombre`, `descripcion`, `fecha_inicio`, `codigo_grupo`, `codigo_lider_proyecto` , archivo) VALUES (:nombre,:descripcion,:fecha ,:codigoGrupo,:codigoPersona , :archivo)");

    // Vincular los valores de los parámetros de la consulta
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':descripcion', $descripcion);
    $stmt->bindParam(':fecha', $fecha_str);
    $stmt->bindParam(':codigoGrupo', $codigoGrupo);
    $stmt->bindParam(':codigoPersona', $codigoPersona);
    $stmt -> bindParam(':archivo' , $nomarchivo);

    // Asignar los valores de los parámetros
    $nombre = $_POST['nombre'];
    $fecha_str = $fecha->format('Y-m-d H:i:s');
    $descripcion = $_POST['descripcion'];
    $codigoGrupo = $_POST['codigoGrupo'];
    $codigoPersona = $_POST['codigoPersona'];
    $archivo = $_FILES['archivo']['name'];
    $nomarchivo = ($archivo != "") ? $fecha -> getTimestamp()."_".$_FILES["archivo"]["name"] : "imagen.jpg";
    $tmpImagen = $_FILES["archivo"]["tmp_name"];
    if($tmpImagen != ""){
        move_uploaded_file($tmpImagen,"../Archivos/".$nomarchivo);
    }

    // Ejecutar la consulta
    $stmt->execute();

    // Verificar si la consulta se ha ejecutado correctamente
    if($stmt->rowCount() > 0){
        echo "La inserción se ha realizado correctamente.";
    }else{
        echo "La inserción no se ha realizado.";
    }
    // Cerrar la conexión con la base de datos
    $conexion = null;
    header("Location: ../vistas/inicio.php");
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>

