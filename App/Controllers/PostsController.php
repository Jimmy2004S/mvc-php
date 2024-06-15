<?php
namespace App\Controllers;

use Lib\Controller;
use App\Model\Posts;

class PostsController extends Controller {

    private $posts;
    public function __construct(){
        parent::__construct();
        $this->posts = new Posts();
    }

    public function verPosts(){
        list($success, $data) = $this->posts->selectPosts();
        if($success){
            $json = [];
            foreach($data as $row){
                $json[] = [
                    'id'            => $row['id'],
                    'title'         => $row['title'],
                    'description' => $row['description'],
                    'created_at'    => $this->posts->formatDate($row['created_at']),
                ];
            }
            http_response_code(200);
            echo json_encode($json);
        }elseif($success === false){
            http_response_code(500);
            echo json_encode(["Error" => $data]);
        }elseif(empty($success)){
            http_response_code(204);
            echo json_encode([]);
        }
    }
}