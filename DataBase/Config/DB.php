<?php 
namespace DataBase\Config;

class DB{
    private $schema;
    private $host;
    private $password;
    private $user;
    function __construct(){
        $this->schema = 'proyectosi';
        $this->host = 'localhost';
        $this->password = '';
        $this->user = 'root';
    }

    public function Connection(){
        try{
            $conexion = new \PDO("mysql:host=$this->host;dbname=$this->schema", $this->user, $this->password);
            if($conexion){
                echo "Connection";
            }else{
                echo "No connection";
            }
        }catch(\PDOException $e){
            echo "No se pudo conectar ala base de datos: $e-> getMessage()";
        }
    }
}