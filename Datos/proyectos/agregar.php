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
$fecha = new DateTime();
// Asignar los valores de los parámetros
 $nombre = isset($_POST['nombreProyecto']) ? $_POST['nombreProyecto'] : '';
 $fecha_str = $fecha->format('d-m-Y H:i');
 $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
 $codigoGrupo = isset($_POST['codigoGrupo']) ? $_POST['codigoGrupo'] : '';
 $codigoPersona = isset($_POST['codigoPersona']) ? $_POST['codigoPersona'] : '';
 $archivo = isset($_FILES['archivo']['name']) ? $_FILES['archivo']['name'] : '';
 $nomarchivo = ($archivo != "") ? $fecha->format('d-m-Y-H-i')."_".$_FILES["archivo"]["name"] : "imagen.jpg";
 
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

        $tmpImagen = $_FILES["archivo"]["tmp_name"];
        if($tmpImagen != ""){
            move_uploaded_file($tmpImagen,"../../Archivos/".$nomarchivo);
        }

        // Ejecutar la consulta
        $stmt->execute();
        echo 'Agregado';
        
        // Cerrar la conexión con la base de datos
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conexion = null;

