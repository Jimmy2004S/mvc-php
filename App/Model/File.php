<?php

namespace App\Model;

use Lib\Model;

class File extends Model
{
    public function __construct()
    {
        parent::__construct();
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

    public function insertFile($pdfName, $pdfPath, $coverImgName, $coverImgPath, $post_id)
    {
        $value = $this->insert([
            'name' => $pdfName,
            'path' => $pdfPath,
            'post_id' => $post_id,
            'type' => 'pdf'
        ]);

        $value = $this->insert([
            'name' => $coverImgName,
            'path' => $coverImgPath,
            'post_id' => $post_id,
            'type' => 'cover_image'
        ]);

        return $value;
    }

    public function deleteFile($post_id){
        $sql = "DELETE FROM files WHERE post_id = :post_id";
        try {
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(":post_id", $post_id, \PDO::PARAM_INT);
            $stmt->execute();
            return [true, "Archivos eliminados"];
        } catch (\PDOException $e) {
            return [false, "Error en el servidor:  --deleteFiles ". $e->getMessage()];
        }
    }
}
