<?php 
    include("../conexion.php");
    //LISTAR
    $sentenciaSQL = $conexion -> prepare("SELECT * FROM proyectos");
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
        'codigoGrupo' => $row['codigo_grupo']
      );
    }
      // Convertir a JSON y enviar respuesta al cliente
    $jsonstring = json_encode($json);
    echo $jsonstring;

?>