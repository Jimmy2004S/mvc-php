<?php 
namespace DataBase\Config;

class DB{
    private $schema;
    private $host;
    private $password;
    private $user;
    function __construct(){
        $this->schema = 'plataforma_proyectos';
        $this->host = 'localhost';
        $this->password = '';
        $this->user = 'root';
    }

    protected function Connection(){
        try{
            $conexion = new \PDO("mysql:host=$this->host;dbname=$this->schema", $this->user, $this->password);
            if($conexion){
                return $conexion;
            }
        }catch(\PDOException $e){
            return "No se pudo conectar ala base de datos: $e-> getMessage()";
        }
    }
}