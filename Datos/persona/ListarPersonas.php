<?php 

  try{
    include("../conexion.php");
    $sentenciaSQL = $conexion -> prepare("SELECT * FROM persona");
    $sentenciaSQL -> execute();
    $listaPersonas = $sentenciaSQL -> fetchAll(PDO::FETCH_ASSOC);      

    $json = array();
    foreach ($listaPersonas as $row) {
      $json[] = array(
        'codigo' => $row['codigo_persona'],
        'nombre' => $row['nombre'],
        'apellido' => $row['apellido'],
        'tipo_persona' => $row['tipo_persona'],
        'telefono' => $row['telefono'],
        'email' => $row['email'],
        'estado' => $row['estado'],
        'clave' => $row['clave']
      );
    }
    // Convertir a JSON y enviar respuesta al cliente
    $jsonstring = json_encode($json);
    echo $jsonstring;
  }catch(Exception $e){
    echo $e->getMessagge();
  }
    

?>


