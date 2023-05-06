<?php
include_once("/Datos/conexion.php");


$codigoProyecto = (isset($_POST["codigoProyecto"]))? $_POST["codigoProyecto"]: "";
$nombre  = (isset($_POST["nombre"]))? $_POST["nombre"]: "";
$descripcion = (isset($_POST["descripcion"]))? $_POST["descripcion"]: "";
$archivo = $_FILES['archivo']['name'];
$codigoPersona = (isset($_POST["codigoPersona"]))? $_POST["codigoPersona"]: "";
$codigoGrupo = (isset($_POST["codigoGrupo"]))? $_POST["codigoGrupo"]: "";

$sentencia = $conexion -> prepare ("UPDATE `proyectos` SET `nombre`=:nombre,`descripcion`= descripcion,`codigo_grupo`=:codigoGrupo,`codigo_lider_proyecto`=:codigoPersona,`archivo`=:archivo WHERE codigo=:codigo");
$sentencia -> bindParam(":nombre" , $nombre);
$sentencia -> bindParam(":descripcion" , $descripcion);
$sentencia -> bindParam(":codigoGrupo" , $codigoGrupo);
$sentencia -> bindParam(":codigoPersona" , $codigoPersona);
$sentencia -> execute();

if($archivo != null){
    $fecha = new DateTime();
    $nomarchivo = ($archivo != "") ? $fecha -> getTimestamp()."_".$_FILES["archivo"]["name"] : "imagen.jpg";
    $tmpImagen = $_FILES["archivo"]["tmp_name"];
    move_uploaded_file($tmpImagen,"archivos/".$nomarchivo);
    
    $sentenciaSQL = $conexion -> prepare("SELECT * FROM tabla WHERE Id=:id");
    $sentenciaSQL -> bindParam(":id" , $id);
    $sentenciaSQL -> execute();
    $lista = $sentenciaSQL -> fetch(PDO::FETCH_LAZY); 

    if(isset($lista["archivo"]) &&  ($lista["archivo"] != "imagen.jpg")){
        if(file_exists("archivos/".$lista["archivo"])){
            unlink("archivos/".$lista["archivo"]);
        }
    }

    $sentencia = $conexion -> prepare ("UPDATE tabla set archivo=:archivo WHERE Id=:id");
    $sentencia -> bindParam(":archivo" , $nomarchivo);
    $sentencia -> bindParam(":id" , $id);
    $sentencia -> execute();
}

header("location:contactos.php");