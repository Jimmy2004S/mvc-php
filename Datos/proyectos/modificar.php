<?php
try {
    $host = 'localhost'; // dirección del servidor de base de datos
    $bd = 'proyectosi'; // nombre de la base de datos
    $user = 'root'; // usuario de la base de datos
    $clave = ''; // contraseña de la base de datos

    $conexion = new PDO("mysql:host=$host; dbname=$bd", $user, $clave);
    // aquí se realiza la conexión y se almacena en la variable $conexion

    if ($conexion) {
        // si la conexión fue exitosa, se puede realizar alguna operación
    }
} catch (PDOException $ex) {
    // si hubo algún error en la conexión, se captura la excepción y se muestra un mensaje de error
    echo 'Error al conectar a la base de datos: ' . $ex->getMessage();
}

date_default_timezone_set('America/Bogota');
$codigoProyecto = (isset($_POST["codigoProyecto"]))? $_POST["codigoProyecto"]: "";
$nombre  = (isset($_POST["nombreProyecto"]))? $_POST["nombreProyecto"]: "";
$descripcion = (isset($_POST["descripcion"]))? $_POST["descripcion"]: "";
$archivo = $_FILES['archivo']['name'];
$codigoPersona = (isset($_POST["codigoPersona"]))? $_POST["codigoPersona"]: "";
$codigoGrupo = (isset($_POST["codigoGrupo"]))? $_POST["codigoGrupo"]: "";
$fecha = (isset($_POST["fecha"]))? $_POST["fecha"]: "";
$fechaSinEspacio = str_replace(' ', '_', $fecha);

try{

    $conexion->beginTransaction();
    $sentencia = $conexion -> prepare ("UPDATE `proyectos` SET `nombre`=:nombre,`descripcion`=:descripcion,`codigo_grupo`=:codigoGrupo,`codigo_lider_proyecto`=:codigoPersona WHERE codigo=:codigo");
    $sentencia -> bindParam(":nombre" , $nombre);
    $sentencia -> bindParam(":descripcion" , $descripcion);
    $sentencia -> bindParam(":codigoGrupo" , $codigoGrupo);
    $sentencia -> bindParam(":codigoPersona" , $codigoPersona);
    $sentencia -> bindParam(":codigo" , $codigoProyecto);
    $sentencia -> execute();
    
    if($archivo != null){
        $fecha = new DateTime();
        $nomarchivo = ($archivo != "") ? $fecha->format('d-m-Y-H-i')."_".$_FILES["archivo"]["name"] : "imagen.jpg";
        $tmpImagen = $_FILES["archivo"]["tmp_name"];
        move_uploaded_file($tmpImagen,"../Archivos/".$nomarchivo);
        
          //Buscar el proyectp
          $sentencia = $conexion -> prepare("SELECT * FROM proyectos WHERE codigo=:codigo");
          $sentencia -> bindParam(":codigo" , $codigoProyecto);
          $sentencia -> execute();
          $lista = $sentencia -> fetch(PDO::FETCH_LAZY); 
  
          //Eliminar el archivo
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
$conexion  = null;