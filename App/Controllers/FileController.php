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
            $this->uploadFile($coverImgName, 'cover_image');
            $this->uploadFile($pdfName, 'pdf');
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
    }


    public function deleteFiles($post_id)
    {
        try {
            $data = $this->file->where('post_id', $post_id)->get();
            if ($data) {
                $projectRoot = dirname(__DIR__, 2);
                foreach ($data as $row) {
                    $path = $projectRoot . '/' . str_replace('\\', '/', $row['path']);
                    if (file_exists($path)) {
                        unlink($path);
                        return true;
                    }else{
                        throw new FileException("Directorio no encontrado");
                    }
                }
            } else {
                throw new NotFoundException();
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
