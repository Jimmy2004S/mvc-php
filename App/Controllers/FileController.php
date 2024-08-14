<?php

namespace App\Controllers;

use App\Exception\FileException;
use App\Exception\NotFoundException;
use App\Model\File;
use App\Resources\FileResources;
use Exception;
use Lib\Controller;

class FileController extends Controller
{

    private $file;
    public function __construct()
    {
        parent::__construct();
        $this->file = new File();
    }

    public function listarFilesPost($post_id)
    {
        try {
            $data = $this->file->where('post_id', $post_id)->get();
            FileResources::getResource($data);
        } catch (Exception $e) {
            http_response_code($e->getCode());
            echo json_encode(["Error" => $e->getMessage()]);
        }
    }

    public function crearFiles($post_id)
    {
        if (isset($_FILES['pdf']['name']) && isset($_FILES['cover_image']['name'])) {
            $this->crearFile($_FILES['pdf']['name'], $post_id, 'pdf');
            $this->crearFile($_FILES['cover_image']['name'], $post_id, 'cover_image');
            return;
        } else {
            throw new FileException("Debe seleccionar un archivo para cada tipo", 400);
        }
    }

    public function crearFile($fileName, $post_id, $type)
    {
        try {
            $this->file->insert(
                [
                    'name' => $fileName,
                    'path' => "public/$type/$fileName",
                    'post_id' => $post_id,
                    'type' => $type
                ]
            );
            $this->uploadFile($fileName, $type);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    private function uploadFile($fileName, $type)
    {

        $projectRoot = dirname(__DIR__, 2);
        $tmpFile = $_FILES[$type]["tmp_name"];

        if ($tmpFile == "") {
            throw new FileException();
        }

        $path = $projectRoot . '\public\\' . $type;

        if (!is_dir($path)) {
            throw new FileException("Directorio no encontrado");
        }

        move_uploaded_file($tmpFile, $path . '/' . $fileName);
        return true;
    }


    public function deleteFiles($post_id)
    {
        try {
            $data = $this->file->where('post_id', $post_id)->get();
            if ($data) {
                foreach ($data as $row) {
                    // Utiliza "/" para construir la ruta
                    $this->deleteFile($row['path']);
                }
                return true;
            } else {
                throw new NotFoundException();
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function deleteFile($path)
    {
        $projectRoot = dirname(__DIR__, 2);
        $path = $projectRoot . '/' . str_replace('\\', '/', $path);
        if (file_exists($path)) {
            unlink($path);
        } else {
            return false;
        }
    }

    public function actualizarPostFiles($post_id)
    {
        if (isset($_FILES['cover_image']['name'])) {
            $file = $this->file->where('post_id', $post_id, '=', ['name', 'path', 'id'])->get();
            
            $coverImageName = $_FILES['cover_image']['name'];
    
            // Si el archivo existe y el nombre del archivo es diferente al que ya está almacenado
            if ($file && $file[1]['name'] !== $coverImageName) {
                // Actualizar el registro en la base de datos
                $updateResult = $this->actualizarfile($coverImageName, $file[1]['id'], 'cover_image');
    
                if ($updateResult) {
                    $this->deleteFile($file[1]['path']);  // Eliminar el archivo anterior
                    $this->uploadFile($coverImageName, 'cover_image');  // Subir el nuevo archivo
                }
    
                return $updateResult;  // Retorna el resultado de la actualización
            }
        }
        return false;  // Retorna falso si no hay archivo para actualizar o no es necesario actualizar
    }
    
    public function actualizarfile($fileName, $file_id, $type)
    {
        try {
            // Actualiza el registro en la base de datos
            $updateResult = $this->file->update([
                'name' => $fileName,
                'path' => "public/$type/$fileName",
                'type' => $type
            ], $file_id);
    
            return $updateResult;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    
}
