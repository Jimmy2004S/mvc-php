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

    try{
        //LISTAR
        $sentenciaSQL = $conexion -> prepare("SELECT * FROM grupo");
        $sentenciaSQL -> execute();
        $listaCodigoGrupo = $sentenciaSQL -> fetchAll(PDO::FETCH_ASSOC);       
        $conexion = null;
        
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } 
?>