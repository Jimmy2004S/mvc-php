<?php 
 $host = "localhost";
 $user = "root";
 $bd = "proyectosi";
 $clave = "";

try{
    $conexion = new PDO("mysql:host=$host; dbname=$bd",$user,$clave);
    if($conexion){
    }
}catch(Exception $ex){
    echo $ex ->getMessage();
}

?>