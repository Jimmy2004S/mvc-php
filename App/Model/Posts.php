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
        $sql = "SELECT * FROM posts";
        try {
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            $lista = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if($lista){
                return [true, $lista];
            }else{
                return [null, "No hay posts"];
            }
        } catch (\PDOException $e) {
            return [false, "Error en el servidor:  --selectposts " . $e->getMessage()];
        }
    }
}
