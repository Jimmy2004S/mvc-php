<?php

namespace App\Controllers;

use Lib\Controller;
use App\Model\Posts;
use App\Resources\PostsResources;
use Lib\Util\Auth;

class PostsController extends Controller
{

    private $posts;
    public function __construct()
    {
        parent::__construct();
        $this->posts = new Posts();
    }

    public function verPosts()
    {
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        $user = Auth::user();
        $auth_user_id = $user['id'];
        list($success, $data) = $this->posts->selectPosts($auth_user_id, $search);
        if ($success) {
            PostsResources::getResource($data);
        } elseif ($success === false) {
            http_response_code(500);
            echo json_encode(["Error" => $data]);
        } elseif (empty($success)) {
            http_response_code(204);
            echo json_encode([]);
        }
    }

    public function verPostsTendencias()
    {
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        $user = Auth::user();
        $auth_user_id = $user['id'];
        list($success, $data) = $this->posts->selectPostsLimitByLikes($auth_user_id, $search);
        if ($success) {
            PostsResources::getResource($data);
        } elseif ($success === false) {
            http_response_code(500);
            echo json_encode(["Error" => $data]);
        } elseif (empty($success)) {
            http_response_code(204);
            echo json_encode([]);
        }
    }

    public function verMisPostsView(){
        $this->view->render('mis-posts');
    }

    public function verMisPosts()
    {
        $user = Auth::user();
        $auth_user_id = $user['id'];
        list($success, $data) = $this->posts->selectPostsByUserId($auth_user_id);
        if ($success) {
            PostsResources::getResource($data);
        } elseif ($success === false) {
            http_response_code(500);
            echo json_encode(["Error" => $data]);
        } elseif (empty($success)) {
            http_response_code(204);
            echo json_encode([]);
        }
    }


    public function verPost($post_id){
        $user = Auth::user();
        $auth_user_id = $user['id'];
        list($success, $data) = $this->posts->selectPostById($post_id, $auth_user_id);
        if ($success === true) {
            PostsResources::getResource($data);
        } elseif ($success === false) {
            http_response_code(500);
            echo json_encode(["Error" => $data]);
        } elseif (empty($success)) {
            http_response_code(204);
            echo json_encode([]);
        }
    }

     public function eliminarPost($post_id){
        $user = Auth::user();
        $auth_user_id = $user['id'];
        list($success, $data) = $this->posts->deletePost($post_id, $auth_user_id);
        if($success === true){
            http_response_code(204);
            echo json_encode([]);
        } elseif($success === false){
            http_response_code(500);
            echo json_encode(["Error" => $data]);
        }elseif($success === null){
            http_response_code(404);
            echo json_encode(["Error" => $data]);
        }
    }
    
}
