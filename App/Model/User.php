<?php

namespace App\Model;

use Lib\Model;

class User extends Model
{

    protected $table = 'users';
    public function __construct()
    {
        parent::__construct();
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

    public function updateUserState($id)
    {
        try {
            $sql = "UPDATE users
                SET state = CASE
                    WHEN state = '1' THEN '0'
                    WHEN state = '0' THEN '1'
                    ELSE state
                END
                WHERE id = :id";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam('id', $id);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return [true, "Cambio de estado exitoso"];
            } else {
                return [null, "No se cambió ningún estado, error en la referencia."];
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

    public function selectById($user_id)
    {
        $sql = "SELECT u.* FROM `personal_access_tokens` pat
                INNER JOIN users u ON u.id = pat.tokenable_id
                WHERE u.id =:id";
        try {
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam('id', $user_id, \PDO::PARAM_INT);
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
