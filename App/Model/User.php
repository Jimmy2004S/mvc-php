<?php

namespace App\Model;

use Lib\Model;
use PDOException;

class User extends Model
{

    protected $table = 'users';
    public function __construct()
    {
        parent::__construct();
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

            return ($stmt->rowCount() > 0 ) ? true : false;

        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }

}
