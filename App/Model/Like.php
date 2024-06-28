<?php

namespace App\Model;

use Lib\Model;

class Like extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function like($post_id, $user_id)
    {
        list($success, $data) = $this->selectLike($post_id, $user_id);
        if ($success === true) {
            return $this->deleteLike($data['id']);
        } elseif ($success === null) {
            return $this->insertLike($post_id, $user_id);
        } else {
            return [false, "Error en el servidor --like " . $data];
        }
    }

    private function insertLike($post_id, $user_id)
    {
        $sql = "INSERT INTO likes (post_id, user_id, created_at) VALUES (:post_id, :user_id, :created_at)";
        try {
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':post_id', $post_id, \PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $user_id, \PDO::PARAM_INT);
            $stmt->bindValue('created_at', $this->basicCurrentFormatDate());
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return [true, "like"];
            }
        } catch (\PDOException $e) {
            return [false, "Error en el servidor ---darlike" . $e];
        }
    }

    private function deleteLike($like_id)
    {
        $sql = "DELETE FROM likes WHERE id = :id";
        try{
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':id', $like_id, \PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return [true, ""];
            }
        }catch(\PDOException $e){
            return [false, "Error en el servidor --deletelike" . $e->getMessage()];
        }
    }


    private function selectLike($post_id, $user_id)
    {
        $sql = "SELECT id FROM likes WHERE user_id = :user_id AND post_id = :post_id";
        try {
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':post_id', $post_id, \PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $user_id, \PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $like = $stmt->fetch(\PDO::FETCH_ASSOC);
                return [true, $like];
            } else {
                return [null, ""];
            }
        } catch (\PDOException $e) {
            return [false, "Error en el servidor ---darlike" . $e];
        }
    }
}
