<?php 

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