<?php
namespace App\Controllers;

use Lib\Controller;
use App\Model\Posts;
use Lib\Util\Auth;
use Lib\Util\Storage;

class PostsController extends Controller {

    private $posts;
    public function __construct(){
        parent::__construct();
        $this->posts = new Posts();
    }

    public function verPosts(){
        if(isset($_GET['search'])){
            $search = $_GET['search'];
        }else{
            $search = '';
        }
        $user = Auth::user();
        $auth_user_id = $user['id'];
        list($success, $data) = $this->posts->selectPosts($auth_user_id, $search);
        if($success){
            $json = [];
            foreach($data as $row){
                $json[] = [
                    'id'                => $row['id'],
                    'title'             => $row['title'],
                    'description'       => $row['description'],
                    'created_at'        => $this->posts->formatDate($row['created_at']),
                    'user_id'           => $row['user_id'],
                    'author'            => $row['author'],
                    'num_likes'         => $row['num_likes'],
                    'semester_student'  => $row['semester_student'],
                    'career_student'    => $row['career_student'],
                    'user_liked'        => $row['user_liked']
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

    public function listarFilesPosts(){
        $post_id = $_GET['post_id'];
        list($success, $data) = $this->posts->selectFilesPosts($post_id);
        if($success){
            $json = [];
            foreach($data as $row){
                $json[] = [
                    'post_id'           => $row['post_id'],
                    'file_name'           => $row['name'],
                    'type'              => $row['type'],
                    'path'              => Storage::path($row['path'])
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