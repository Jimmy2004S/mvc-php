<?php
session_start();
$codigoPersonaLogin = $_SESSION['codigo'];

    try{
        //LISTAR
        $sentenciaSQL = $conexion -> prepare("SELECT g.codigo_grupo, g.nombre, p.nombre as nombre_persona , p.apellido , gp.codigo_persona
        FROM grupo_persona gp
        JOIN grupo g ON gp.codigo_grupo = g.codigo_grupo
        JOIN persona p ON gp.codigo_persona = p.codigo_persona
        WHERE gp.codigo_persona = 20222;");
        $sentenciaSQL -> bindParam(":codigo" , $codigoPersonaLogin);
        $sentenciaSQL -> execute();
        $listaMisGrupos = $sentenciaSQL -> fetchAll(PDO::FETCH_ASSOC);       

        $json = array();
        foreach ($listaPersonas as $row) {
          $json[] = array(
            'codigo_grupo' => $row['codigo_grupo'],
            'nombre' => $row['codigo_grupo'],
          );
        }
          // Convertir a JSON y enviar respuesta al cliente
        $jsonstring = json_encode($json);
        echo $jsonstring;
    
        $conexion = null;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } 
?>