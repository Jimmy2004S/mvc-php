<?php

namespace App\Model;

use Lib\Model;
use Lib\Util\Auth;

class Posts extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function selectPosts($auth_user_id, $search)
    {
        $sql = "SELECT p.*, COUNT(l.post_id) AS num_likes, 
                u.user_name AS author, s.career AS career_student,
                s.semester AS semester_student,
                CASE WHEN EXISTS (SELECT 1 FROM likes WHERE post_id = p.id AND user_id = :auth_user_id) THEN TRUE ELSE FALSE END AS user_liked
                FROM posts p
                INNER JOIN users u ON u.id = p.user_id
                LEFT JOIN students s on s.user_id = p.user_id
                LEFT JOIN likes l ON l.post_id = p.id
                WHERE s.career LIKE :search OR LOWER(CONCAT('Semestre ', s.semester)) LIKE LOWER(:search) OR u.user_name LIKE :search
                GROUP BY p.id
                ORDER BY p.created_at DESC";

        try {
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':auth_user_id', $auth_user_id, \PDO::PARAM_INT);
            $searchWildcard = "%$search%";
            $stmt->bindParam(':search', $searchWildcard, \PDO::PARAM_STR);
            $stmt->execute();
            $lista = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if ($lista) {
                return [true, $lista];
            } else {
                return [null, "No hay posts"];
            }
        } catch (\PDOException $e) {
            return [false, "Error en el servidor:  --selectposts " . $e->getMessage()];
        }
    }

    public function selectFilesPosts($post_id)
    {
        $sql = "SELECT path,type,post_id,name FROM files WHERE post_id = :post_id";
        try {
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(":post_id", $post_id, \PDO::PARAM_INT);
            $stmt->execute();
            $lista = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if ($stmt->rowCount() > 0) {
                return [true, $lista];
            } else {
                return [null, "No hay archivos"];
            }
        } catch (\PDOException $e) {
            return [false, "Error en el servidor:  --selectfiles " . $e->getMessage()];
        }
    }
}
