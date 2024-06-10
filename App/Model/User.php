<?php

namespace App\Model;

use Lib\Model;

class User extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function autenticar($email, $clave)
    {
        $sql = "SELECT * FROM persona WHERE email = :email AND clave = :clave";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam('email', $email);
        $stmt->bindParam('clave', $clave);
        $stmt->execute();
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($user) {
            return $user;
        } else {
            return false;
        }
    }

    public function select()
    {
        try {
            $sql = "SELECT * FROM persona";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            $lista = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return [true, $lista];
        } catch (\PDOException $e) {
            return [false, "Error en el servidor: " . $e->getMessage()];
        }
    }

    public function selectByCodigo($codigo){
        $sql = "SELECT * FROM persona WHERE codigo = :codigo";
        try{
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam('codigo', $codigo , \PDO::PARAM_INT);
            $stmt->execute();
            $list = $stmt->fetch(\PDO::FETCH_ASSOC);
            if($list){
                return [true, $list];
            }else{
                return [ null , $list];
            }
        }catch(\PDOException $e){
            return [false, "Error en el servidor: ". $e->getMessage()];
        }

    }

    public function cambiarEstadoUsuario($codigo)
    {
        try {
            $sql = "UPDATE persona
                SET estado = CASE
                    WHEN estado = 'Activo' THEN 'Inhabilitado'
                    WHEN estado = 'Inhabilitado' THEN 'Activo'
                    ELSE estado
                END
                WHERE codigo = :codigo";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam('codigo', $codigo);
            if($stmt->execute()){
                return [true, "Cambio de estado exitoso"];
            }
        } catch (\PDOException $e) {
            return [false, "Error en el servidor: " . $e->getMessage()];
        }
    }
}
