<?php

namespace App\Model;

use Lib\Model;

class User extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function autenticar($email, $password)
    {
        list($success, $data) = $this->selectByEmail($email);
        if ($success === true) {
            if (password_verify($password, $data['password'])) {
                list($success, $dataToken) = $this->generarToken($data['id'], $data['role_id']);
                if ($success === true) {
                    return [true, $data, $dataToken];
                } elseif ($success === false) {
                    return [false, $dataToken, null];
                }
            } else {
                return [null, "Contraseña incorrecta", null];
            }
        } elseif ($success === null) {
            return [null, $data, null];
        } elseif ($success === false) {
            return [false, $data, null];
        }
    }

    public function select()
    {
        $sql = "SELECT * FROM users WHERE NOT role_id =:role_id";
        try {
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindValue(':role_id', 1);
            $stmt->execute();
            $lista = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if ($lista) {
                return [true, $lista];
            } else {
                return [null, "No hay usuarios"];
            }
        } catch (\PDOException $e) {
            return [false, "Error en el servidor: " . $e->getMessage()];
        }
    }

    public function selectByCodigo($codigo)
    {
        $sql = "SELECT * FROM persona WHERE codigo = :codigo";
        try {
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam('codigo', $codigo, \PDO::PARAM_INT);
            $stmt->execute();
            $list = $stmt->fetch(\PDO::FETCH_ASSOC);
            if ($list) {
                return [true, $list];
            } else {
                return [null, $list];
            }
        } catch (\PDOException $e) {
            return [false, "Error en el servidor: " . $e->getMessage()];
        }
    }

    public function selectByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email =:email";
        try {
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam('email', $email);
            $stmt->execute();
            $user = $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return [false, "Error en el servidor --selectbyemail: " . $e->getMessage()];
        }

        if ($user) {
            return [true, $user];
        } else {
            return [null, "El usuario no existe"];
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
            if ($stmt->execute()) {
                return [true, "Cambio de estado exitoso"];
            }
        } catch (\PDOException $e) {
            return [false, "Error en el servidor: " . $e->getMessage()];
        }
    }

    public function verificarRole($role_id)
    {
        return ($role_id == 1) ? "Administrador" : ($role_id == 2 ? "Estudiante" : "Profesor");
    }

    public function revocarTokens($user_id)
    {
        $sql = "DELETE FROM `personal_access_tokens` WHERE `tokenable_id` =:tokenable_id";
        try {
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':tokenable_id', $user_id);
            $stmt->execute();
            return [true, "Tokens revocados"];
        } catch (\PDOException $e) {
            return [false, "Error del servidor --revokartokens : " . $e->getMessage()];
        }
    }

    public function userLogueado($user_id)
    {
        $sql = "SELECT * FROM users WHERE id =:id";
        try {
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam('id', $user_id);
            $stmt->execute();
            $user = $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return [false, "Error en el servidor --userlogueado: " . $e->getMessage()];
        }

        if ($user) {
            return [true, $user];
        } else {
            return [null, "El usuario no esta logueado"];
        }
    }
    
    private function generarToken($userid, $role_id)
    {
        $token = bin2hex(random_bytes(32));
        $sql = "INSERT INTO `personal_access_tokens` (`tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`) 
        VALUES (:tokenable_type, :tokenable_id, :name, :token, :abilities)";
        $user_abilitie = $this->verificarRole($role_id);
        try {
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindValue(':tokenable_type', "App\Models\User");
            $stmt->bindParam(':tokenable_id', $userid);
            $stmt->bindValue(':name', 'api_token');
            $stmt->bindParam(':token', $token);
            $stmt->bindParam(':abilities', $user_abilitie);
            $stmt->execute();
            return [true, $token];
        } catch (\PDOException $e) {
            return [false, "Error en el servidor --generartoken: " . $e->getMessage()];
        }
    }
}
