<?php

namespace App\Controllers;

use Lib\Controller;
use App\Model\Posts;
use App\Resources\PostsResources;
use Lib\Util\Auth;

class PostsController extends Controller
{

    private $posts;
    private $fileController;
    public function __construct()
    {
        parent::__construct();
        $this->posts = new Posts();
        $this->fileController = new FileController();
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

    public function verMisPostsView()
    {
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


    public function verPost($post_id)
    {
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

    public function crearPost()
    {
        $user = Auth::user();
        $auth_user_id = $user['id'];
        $title = isset($_POST['title']) ? $_POST['title'] : '';
        $description = isset($_POST['description']) ? $_POST['description'] : '';
        list($success, $data) = $this->posts->insertPost($title, $description, $auth_user_id);
        if ($success === true) {
            list($success, $data) = $this->fileController->crearFiles($data);
            if ($success === true) {
                http_response_code(201);
                echo json_encode($data);
                return;
            }
        }
        http_response_code(500);
        echo json_encode(["Error" => $data]);
    }

    public function eliminarPost($post_id)
    {
        $user = Auth::user();
        $auth_user_id = $user['id'];
        list($success, $data) = $this->fileController->deleteFiles($post_id);
        if ($success === true) {
            list($success, $data) = $this->posts->deletePost($post_id, $auth_user_id);
            if ($success === true) {
                http_response_code(204);
                echo json_encode([]);
                return;
            }
        } 
        if ($success === null) {
            http_response_code(404);
            echo json_encode(["Error" => $data]);
            return;
        }
        if($success === false){
            http_response_code(500);
            echo json_encode(["Error" => $data]);
            return;
        }
    }
}
