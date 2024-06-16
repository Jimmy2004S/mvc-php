<?php

namespace App\Model;

use Lib\Model;

class Posts extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function selectPosts()
    {
        $sql = "SELECT p.*, COUNT(l.post_id) AS num_likes, 
                u.user_name AS author, s.career AS career_student,
                s.semester AS semester_student
                FROM posts p
                INNER JOIN users u ON u.id = p.user_id
                LEFT JOIN students s on s.user_id = p.user_id
                LEFT JOIN likes l ON l.post_id = p.id
                GROUP BY p.id
                ORDER BY p.created_at DESC;";
        try {
            $stmt = $this->conexion->prepare($sql);
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
}
