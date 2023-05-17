<?php 
session_start();
$codigoPersonaLogin = $_SESSION['codigo'];
    include("../conexion.php");
    try{
      $sentenciaSQL = $conexion -> prepare("SELECT p.*, 
      CASE WHEN pl.id IS NULL THEN FALSE ELSE TRUE END AS dio_like, per.tipo_persona,
      CONCAT(per.nombre, ' ', per.apellido) AS nombre_lider,
      CASE WHEN per.tipo_persona = 'Estudiante' THEN est.carrera
          ELSE ''
      END AS carrera,
      CASE WHEN per.tipo_persona = 'Estudiante' THEN est.semestre
          ELSE ''
      END AS semestre,
      CASE WHEN per.tipo_persona = 'Profesor' THEN pro.departamento
          ELSE ''
      END AS departamento
      FROM proyectos p
      LEFT JOIN proyectos_likes pl ON p.codigo = pl.proyecto_id AND pl.usuario_id = :codigo
      JOIN persona per ON p.codigo_lider_proyecto = per.codigo_persona
      LEFT JOIN estudiante est ON per.codigo_persona = est.codigo
      LEFT JOIN profesor pro ON per.codigo_persona = pro.codigo
      ORDER BY p.fecha_inicio DESC;");
      $sentenciaSQL -> bindParam(":codigo" , $codigoPersonaLogin);
      $sentenciaSQL -> execute();
      $lista = $sentenciaSQL -> fetchAll(PDO::FETCH_ASSOC);       
  
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
          'dio_like' => $row['dio_like'],
          'nombre_lider' => $row['nombre_lider'],
          'tipo_persona' => $row['tipo_persona'],
          'departamento' => $row['departamento'],
          'semestre' => $row['semestre'],
          'carrera' => $row['carrera']
        );
      }
        // Convertir a JSON y enviar respuesta al cliente
      $jsonstring = json_encode($json);
      echo $jsonstring;
    }catch(Exception $e){
      $e->getMessage();
    }
   

?>