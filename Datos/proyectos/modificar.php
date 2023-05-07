<?php

$codigoProyecto = (isset($_POST["codigoProyecto"]))? $_POST["codigoProyecto"]: "";
$nombre  = (isset($_POST["nombre"]))? $_POST["nombre"]: "";
$descripcion = (isset($_POST["descripcion"]))? $_POST["descripcion"]: "";
$archivo = $_FILES['archivo']['name'];
$codigoPersona = (isset($_POST["codigoPersona"]))? $_POST["codigoPersona"]: "";
$codigoGrupo = (isset($_POST["codigoGrupo"]))? $_POST["codigoGrupo"]: "";
$fecha = (isset($_POST["fecha"]))? $_POST["fecha"]: "";
$fechaSinEspacio = str_replace(' ', '_', $fecha);

try{

    include_once("../Datos/conexion.php");
    $conexion->beginTransaction();
    
    $sentencia = $conexion -> prepare ("UPDATE `proyectos` SET `nombre`=:nombre,`descripcion`=:descripcion,`codigo_grupo`=:codigoGrupo,`codigo_lider_proyecto`=:codigoPersona WHERE codigo=:codigo");
    $sentencia -> bindParam(":nombre" , $nombre);
    $sentencia -> bindParam(":descripcion" , $descripcion);
    $sentencia -> bindParam(":codigoGrupo" , $codigoGrupo);
    $sentencia -> bindParam(":codigoPersona" , $codigoPersona);
    $sentencia -> bindParam(":codigo" , $codigoProyecto);
    $sentencia -> execute();
    
    if($archivo != null){
        $nomarchivo = ($archivo != "") ? "_" . $_FILES["archivo"]["name"] : "imagen.jpg";

        $tmpImagen = $_FILES["archivo"]["tmp_name"];
        move_uploaded_file($tmpImagen,"../Archivos/".$nomarchivo);
        
        $sentenciaSQL = $conexion -> prepare("SELECT * FROM proyectos WHERE codigo=:codigo");
        $sentenciaSQL -> bindParam(":codigo" , $codigoProyecto);
        $sentenciaSQL -> execute();
        $lista = $sentenciaSQL -> fetch(PDO::FETCH_LAZY); 
    
        if(isset($lista["archivo"]) &&  ($lista["archivo"] != "imagen.jpg")){
            if(file_exists("../Archivos/".$lista["archivo"])){
                unlink("../Archivos/".$lista["archivo"]);
            }
        }
    
        $sentencia = $conexion -> prepare ("UPDATE proyectos set archivo=:archivo WHERE codigo=:codigo");
        $sentencia -> bindParam(":archivo" , $nomarchivo);
        $sentencia -> bindParam(":codigo" , $codigoProyecto);
        $sentencia -> execute();
    }
    
        // Confirmar transacción
        $conexion->commit();
}catch (PDOException $e) {
    // Cancelar transacción en caso de error
    $conexion->rollback();
    echo "Error al modificar: " . $e->getMessage();
}
