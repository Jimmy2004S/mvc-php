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

    public function insert($pdfName, $pdfPath, $coverImgName, $coverImgPath, $post_id)
    {
        $sql = "INSERT INTO `files` (`name`, `path`, `post_id`, `type`) VALUES 
                (:pdfName, :pdfPath, :post_id, 'pdf'),
                (:coverImgName, :coverImgPath, :post_id, 'cover_image')";
        try {
            $stmt = $this->conexion->prepare($sql);
            // Asignar los valores a los parámetros
            $stmt->bindParam(':pdfName', $pdfName);
            $stmt->bindParam(':pdfPath', $pdfPath);
            $stmt->bindParam(':coverImgName', $coverImgName);
            $stmt->bindParam(':coverImgPath', $coverImgPath);
            $stmt->bindParam(':post_id', $post_id);
            // Ejecutar la consulta
            $stmt->execute();
            return [true, "Archivo agregado"];
        } catch (\PDOException $e) {
            return [false, "Error en el servidor:  --insertFile " . $e->getMessage()];
        }
    }

    public function delete($post_id){
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
