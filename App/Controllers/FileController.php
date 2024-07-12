<?php 
namespace App\Controllers;

use App\Model\File;
use Lib\Controller;
use Lib\Util\Storage;

class FileController extends Controller{

    private $file;
    public function __construct()
    {
        parent::__construct();
        $this->file = new File();
    }
    public function listarFilesPost(        $post_id)
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
}