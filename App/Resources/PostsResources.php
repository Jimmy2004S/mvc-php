<?php

namespace App\Resources;

use Lib\Resources;
use Lib\Util\ModelFormat;

class PostsResources extends Resources
{

    use ModelFormat;

    public function __construct(){
        parent::__construct();
    }

    public static function getResource($data)
    {
        $instance = new self();
        $json = [];
        foreach ($data as $row) {
            $json[] = [
                'id'                => $row['id'],
                'title'             => $row['title'],
                'description'       => $row['description'],
                'created_at'        => $instance->formatDate($row['created_at']),
                'user_id'           => $row['user_id'],
                'author'            => $row['author'],
                'num_likes'         => $row['num_likes'],
                'semester_student'  => $row['semester_student'],
                'career_student'    => $row['career_student'],
                'user_liked'        => $row['user_liked']
            ];
        }
        $instance->jsonResponse($json);
    }
}
