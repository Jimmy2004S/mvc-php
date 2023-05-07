<?php
include("../conexion.php");
if (!empty($_POST['search'])) {
  $search = $_POST['search'];

  // Realizar consulta SQL
  $sentenciaSQL = $conexion->prepare("SELECT * FROM persona WHERE nombre LIKE '$search%'");
  $sentenciaSQL->execute();
  $listaPersonas = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

  if (!$listaPersonas) {
    die("Error");
  }

  // Crear array asociativo
  $json = array();
  foreach ($listaPersonas as $row) {
    $json[] = array(
      'nombre' => $row['nombre'],
      'descripcion' => $row['identificacion']
    );
  }

  // Convertir a JSON y enviar respuesta al cliente
  $jsonstring = json_encode($json);
  echo $jsonstring;
} else {
  echo "No se recibió el parámetro 'search'";
}

?>



