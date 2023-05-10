<?php 
session_start();
$codigoPersonaLogin = $_SESSION['codigo'];
    include("../conexion.php");
    //LISTAR
    $sentenciaSQL = $conexion -> prepare("SELECT p.*, pl.id AS like_id, 
    CASE WHEN pl.id IS NULL THEN FALSE ELSE TRUE END AS dio_like FROM proyectos p 
    LEFT JOIN proyectos_likes pl ON p.codigo = pl.proyecto_id AND pl.usuario_id = :codigo
    ORDER BY p.fecha_inicio DESC;");
    $sentenciaSQL -> bindParam(":codigo" , $codigoPersonaLogin);
    $sentenciaSQL -> execute();
    $lista = $sentenciaSQL -> fetchAll(PDO::FETCH_ASSOC);       
    
    if(!$lista){
        die('Error listar proyecto');
    }


    $json = array();
    foreach ($lista as $row) {
      $json[] = array(
        'codigo' => $row['codigo'],
        'nombre' => $row['nombre'],
        'descripcion' => $row['descripcion'],
        'fecha_inicio' => $row['fecha_inicio'],
        'likes' => $row['likes'],
        'archivo' => $row['archivo'],
        'codigoGrupo' => $row['codigo_grupo'],
        'codigoLider' => $row['codigo_lider_proyecto'],
        'dio_like' => $row['dio_like']
      );
    }
      // Convertir a JSON y enviar respuesta al cliente
    $jsonstring = json_encode($json);
    echo $jsonstring;

?>