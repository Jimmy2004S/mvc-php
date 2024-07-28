<?php

namespace App\Controllers;

use App\Exception\FileUploadException;
use App\Model\File;
use Exception;
use Lib\Controller;
use Lib\Util\Storage;
use RuntimeException;

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
        list($success, $data) = $this->file->selectFilesPosts($post_id);
        if ($success) {
            $json = [];
            foreach ($data as $row) {
                $json[] = [
                    'post_id'           => $row['post_id'],
                    'file_name'         => $row['name'],
                    'type'              => $row['type'],
                    'path'              => Storage::path($row['path'])
                ];
            }
            http_response_code(200);
            echo json_encode($json);
        } elseif ($success === false) {
            http_response_code(500);
            echo json_encode(["Error" => $data]);
        } elseif (empty($success)) {
            http_response_code(204);
            echo json_encode([]);
        }
    }


    public function crearFiles($post_id)
    {
        $pdfName = isset($_FILES['pdf']['name']) ? $_FILES['pdf']['name'] : '';
        $coverImgName = isset($_FILES['cover_image']['name']) ? $_FILES['cover_image']['name']  : '';

        try {
            $this->file->insert(
                [
                    'name' => $pdfName,
                    'path' => 'public/pdf/' . $pdfName,
                    'post_id' => $post_id,
                    'type' => 'pdf'
                ]
            );
            $this->file->insert(
                [
                    'name' => $coverImgName,
                    'path' => 'public/cover_image/' . $coverImgName,
                    'post_id' => $post_id,
                    'type' => 'cover_image'
                ]
            );
            $this->uploadFiles($coverImgName, $pdfName);
        } catch (Exception $e) {
            throw new RuntimeException($e->getMessage());
        }catch (FileUploadException $e) {
            throw new RuntimeException($e->getMessage());
        }
        
    }

    private function uploadFiles($coverimgName, $pdfName)
    {
        try {
            $projectRoot = dirname(__DIR__, 2);
            $tmpPdf = $_FILES["pdf"]["tmp_name"];
            $tmpCoverImg = $_FILES["cover_image"]["tmp_name"];
    
            if ($tmpCoverImg != "") {
                $path = $projectRoot . '\public\cover_image';
                if (!is_dir($path)) {
                    throw new FileUploadException("Directory does not exist: " . $path);
                }
                move_uploaded_file($tmpCoverImg, $path . '/' . $coverimgName);
            }
            if ($tmpPdf != "") {
                $path = $projectRoot . '\public\pdf';
                if (!is_dir($path)) {
                    throw new FileUploadException("Directory does not exist: " . $path);
                }
                move_uploaded_file($tmpPdf, $path . '/' . $pdfName);
            }
            return true;
        } catch (FileUploadException $e) {
            throw new \Exception($e->getMessage());
        } finally {
            // Restaurar el manejador de errores original
            restore_error_handler();
        }
    }
    

    public function deleteFiles($post_id)
    {
        list($success, $data) = $this->file->selectFilesPosts($post_id);
        if ($success) {
            try {
                $projectRoot = dirname(__DIR__, 2);
                foreach ($data as $row) {
                    $path = $projectRoot . '/' . str_replace('\\', '/', $row['path']);
                    if (file_exists($path)) {
                        unlink($path);
                    }
                }
                return [true, ''];
            } catch (Exception $e) {
                return [false, 'Error al eliminar los archivos del post'];
            }
        } else {
            return [false, 'Error al seleccionar los archivos del post'];
        }
    }
}
