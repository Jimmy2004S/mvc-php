<?php
session_start();
$codigoPersonaLogin = $_SESSION['codigo'];
include("../conexion.php");

    try{
        //LISTAR
        $stmt = $conexion -> prepare("SELECT g.codigo_grupo, g.nombre
        FROM grupo_persona gp
        JOIN grupo g ON gp.codigo_grupo = g.codigo_grupo
        WHERE gp.codigo_persona = :codigo;");
        $stmt -> bindParam(":codigo" , $codigoPersonaLogin);
        $stmt -> execute();
        $listaMisGrupos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $json = array();
        foreach ($listaMisGrupos as $row) {
          $json[] = array(
            'codigo_grupo' => $row['codigo_grupo'],
            'nombre' => $row['nombre']
          );
        }
        // Convertir a JSON y enviar respuesta al cliente
        $jsonstring = json_encode($json);
        echo $jsonstring;
    
        $conexion = null;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    } 
?>