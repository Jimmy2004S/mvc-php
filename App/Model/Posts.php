<?php

namespace App\Model;

use App\Exception\AccessDenied;
use App\Exception\ForbiddenException;
use App\Exception\NotFoundException;
use FontLib\Exception\FontNotFoundException;
use Lib\Model;
use Lib\Util\Auth;

class Posts extends Model
{
    protected $table = 'posts';
    private const SQL_BASE_SELECT = "SELECT p.*, COUNT(l.post_id) AS num_likes, 
                u.user_name AS author, s.career AS career_student,
                s.semester AS semester_student,
                CASE WHEN EXISTS (SELECT 1 FROM likes WHERE post_id = p.id AND user_id = :auth_user_id) THEN TRUE ELSE FALSE END AS user_liked
                FROM posts p
                INNER JOIN users u ON u.id = p.user_id
                LEFT JOIN students s on s.user_id = p.user_id
                LEFT JOIN likes l ON l.post_id = p.id";

    public function __construct()
    {
        parent::__construct();
    }

    public function selectPosts($auth_user_id, $search)
    {
        $sql = self::SQL_BASE_SELECT . " WHERE s.career LIKE :search OR LOWER(CONCAT('Semestre ', s.semester)) LIKE LOWER(:search) OR u.user_name LIKE :search
                GROUP BY p.id
                ORDER BY p.created_at DESC";
        try {
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':auth_user_id', $auth_user_id, \PDO::PARAM_INT);
            $searchWildcard = "%$search%";
            $stmt->bindParam(':search', $searchWildcard, \PDO::PARAM_STR);
            $stmt->execute();
            $lista = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $lista ?: [];
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage());
        }
    }

    public function selectPostsLimitByLikes($auth_user_id, $search)
    {
        $sql = self::SQL_BASE_SELECT . " 
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
            return $lista ?: [];
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage());
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
            return $lista ?: [];
        } catch (\PDOException $e) {
           throw new \PDOException($e->getMessage());
        }
    }

    public function selectPostById($post_id, $auth_user_id)
    {
        $sql = self::SQL_BASE_SELECT . " 
        WHERE p.id = :post_id
        GROUP BY p.id
        ORDER BY p.created_at DESC";
        try {
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(":post_id", $post_id, \PDO::PARAM_INT);
            $stmt->bindParam(":auth_user_id", $auth_user_id, \PDO::PARAM_INT);
            $stmt->execute();
            $post = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $post ?: [];
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage());
        }
    }

    public function deletePost($post_id, $auth_user_id)
    {
        try{
            $result = $this->find($post_id, ['user_id']);
        if ($result) {
            if ($result['user_id'] == $auth_user_id) {
                return $this->delete($post_id);
            } else {
                throw new ForbiddenException();
            }
        } else {
            throw new NotFoundException();
        }
        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        } 
        
    }
}
