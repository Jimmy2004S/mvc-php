<?php

namespace App\Model;

use DataBase\Config\DB;

class User
{

    private $conexion;
    public function __construct()
    {
        $con = new DB();
        $this->conexion = $con->Connection();
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
}
