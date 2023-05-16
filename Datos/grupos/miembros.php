<?php 
include("../conexion.php");
 try{
    $codigoGrupo = $_POST["codigoGrupo"];
    $sql = "SELECT CONCAT(p.nombre, ' ', p.apellido) AS miembros , p.codigo_persona 
    FROM grupo_persona gp
    JOIN grupo g ON gp.codigo_grupo = g.codigo_grupo
    JOIN persona p ON gp.codigo_persona = p.codigo_persona
    WHERE g.codigo_grupo = :codigo;";
    $stmt = $conexion -> prepare($sql);
    $stmt -> bindParam(":codigo" , $codigoGrupo);
    $stmt -> execute();
    $listaMiembros = $stmt -> fetchAll(PDO::FETCH_ASSOC);       
    
    $json = array();
        foreach ($listaMiembros as $row) {
          $json[] = array(
            'miembro' => $row['miembros'],
            'codigo_persona' => $row['codigo_persona']
          );
        }
        // Convertir a JSON y enviar respuesta al cliente
        $jsonstring = json_encode($json);
        echo $jsonstring;
    
    
    $conexion = null;

  } catch (Exception $e) {
    echo "Error: " . $e->getMessage();
  }