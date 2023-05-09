<?php
try{
    $codigo = (isset($_POST["codigo"]))? $_POST["codigo"]: "";
    if($codigo){
        include("../conexion.php");
        $conexion->beginTransaction();

        //Buscar el proyectp
        $sentenciaSQL = $conexion -> prepare("SELECT * FROM proyectos WHERE codigo=:codigo");
        $sentenciaSQL -> bindParam(":codigo" , $codigo);
        $sentenciaSQL -> execute();
        $lista = $sentenciaSQL -> fetch(PDO::FETCH_LAZY); 

        //Eliminar el archivo
        if(isset($lista["archivo"]) &&  ($lista["archivo"] != "imagen.jpg")){
            if(file_exists("../../Archivos/".$lista["archivo"])){
                unlink("../../Archivos/".$lista["archivo"]);
            }
        }
        
        $archivo = $lista['archivo'];
        echo "<script>console.log('archivo a eliminar'. $archivo);</script>";



        $sql = "DELETE FROM `proyectos` WHERE codigo=:codigo";
        $stmt = $conexion->prepare($sql);
        $stmt ->bindParam(":codigo", $codigo);
        $stmt -> execute();

        if(!$stmt){
            echo 'No se pudo eliminar';
        }else{
            echo 'Eliminado';
        }
    }
    $conexion->commit();
}catch(PDOException $e){
    $conexion -> rollback();
    echo 'Error: ' . $e -> getMessage();
}
$conexion = null;