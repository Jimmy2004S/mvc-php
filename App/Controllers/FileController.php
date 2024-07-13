<?php

namespace App\Controllers;

use App\Model\File;
use Exception;
use Lib\Controller;
use Lib\Util\Storage;

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
        list($success, $data) = $this->file->insert($pdfName, 'public/pdf/' . $pdfName, $coverImgName, 'public/cover_image/' . $coverImgName, $post_id);
        if ($success === true) {
            list($success, $data) = $this->uploadFiles($coverImgName, $pdfName);
            if ($success === true) {
                return [true, ''];
            }
        }
        return [false, $data];
    }

    private function uploadFiles($coverimgName, $pdfName)
    {
        try {
            $projectRoot = dirname(__DIR__, 2);
            $tmpPdf = $_FILES["pdf"]["tmp_name"];
            $tmpCoverImg = $_FILES["cover_image"]["tmp_name"];
            if ($tmpCoverImg != "") {
                $path =  $projectRoot . '\public\cover_image';
                move_uploaded_file($tmpCoverImg, $path . '/' . $coverimgName);
            }
            if ($tmpPdf != "") {
                $path =  $projectRoot . '\public\pdf';
                move_uploaded_file($tmpPdf, $path . '/' . $pdfName);
            }
            return [true, ''];
        } catch (Exception $e) {
            return [false, $e->getMessage()];
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
