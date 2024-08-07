<?php

namespace App\Resources;

use Lib\Resources;
use Lib\Util\ModelFormat;
use Lib\Util\Storage;

class FileResources extends Resources
{

    use ModelFormat;

    public function __construct(){
        parent::__construct();
    }

    protected function processData($data)
    {
        $json = [];
        foreach ($data as $row) {
            $json[] = [
                'post_id'           => $row['post_id'],
                'file_name'         => $row['name'],
                'type'              => $row['type'],
                'path'              => Storage::path($row['path'])
            ];
        }
        $this->jsonResponse($json);
    }
}
