<?php

namespace App\Model;

use Lib\Model;
use Lib\Util\Auth;

class Posts extends Model
{
    protected $table = 'posts';
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

    public function selectPostsLimitByLikes($auth_user_id, $search)
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
                ORDER BY COUNT(l.post_id) DESC
                LIMIT 2";

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

    public function selectPostsByUserId($user_id)
    {
        $sql = "SELECT p.*, COUNT(l.post_id) AS num_likes, 
                u.user_name AS author, s.career AS career_student,
                s.semester AS semester_student,
                CASE WHEN EXISTS (SELECT 1 FROM likes WHERE post_id = p.id AND user_id = :user_id) THEN TRUE ELSE FALSE END AS user_liked
                FROM posts p
                INNER JOIN users u ON u.id = p.user_id
                LEFT JOIN students s on s.user_id = p.user_id
                LEFT JOIN likes l ON l.post_id = p.id
                WHERE p.user_id = :user_id
                GROUP BY p.id
                ORDER BY p.created_at DESC";
        try {
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(":user_id", $user_id, \PDO::PARAM_INT);
            $stmt->execute();
            $lista = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if ($lista) {
                return [true, $lista];
            } else {
                return [null, "No hay posts"];
            }
        } catch (\PDOException $e) {
            return [false, "Error en el servidor:  --selectpostsbyuser " . $e->getMessage()];
        }
    }

    public function selectPostById($post_id , $auth_user_id)
    {
        $sql = "SELECT p.*, COUNT(l.post_id) AS num_likes, 
        u.user_name AS author, s.career AS career_student,
        s.semester AS semester_student,
        CASE WHEN EXISTS (SELECT 1 FROM likes WHERE post_id = p.id AND user_id = :auth_user_id) THEN TRUE ELSE FALSE END AS user_liked
        FROM posts p
        INNER JOIN users u ON u.id = p.user_id
        LEFT JOIN students s on s.user_id = p.user_id
        LEFT JOIN likes l ON l.post_id = p.id
        WHERE p.id = :post_id
        GROUP BY p.id
        ORDER BY p.created_at DESC";
        try {
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(":post_id", $post_id, \PDO::PARAM_INT);
            $stmt->bindParam(":auth_user_id", $auth_user_id, \PDO::PARAM_INT);
            $stmt->execute();
            $post = $stmt->fetch(\PDO::FETCH_ASSOC);
            if ($post) {
                return [true, [$post]];
            } else {
                return [null, "Post no encontrado"];
            }
        } catch (\Exception $e) {
            return [false, "Error en el servidor --selectpost " . $e->getMessage()];
        }
    }

    public function insertPost($title, $description, $user_id){
        return $this->insert(['title', 'description', 'user_id'], [$title, $description, $user_id]);
    }

    public function deletePost($post_id, $auth_user_id)
    {
        list($success, $data) = $this->selectPostById($post_id, $auth_user_id);
        if ($success === true) {
            if ($data[0]['user_id'] == $auth_user_id) {
                $sql = "DELETE FROM posts WHERE id = :post_id";
                try {
                    $stmt = $this->conexion->prepare($sql);
                    $stmt->bindParam(":post_id", $post_id, \PDO::PARAM_INT);
                    $stmt->execute();
                    return [true, "Post eliminado"];
                } catch (\PDOException $e) {
                    return [false, $e->getMessage()];
                }
            } else {
                return [null, "No tienes permisos para eliminar este post"];
            }
        } else {
            return [$success, $data];
        }
    }

}
