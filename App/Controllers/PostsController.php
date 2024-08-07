<?php

namespace App\Controllers;

use Lib\Controller;
use App\Model\Posts;
use App\Resources\PostsResources;
use Exception;
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
        try {
            $data = $this->posts->selectPosts($auth_user_id, $search);
            PostsResources::getResource($data);
        } catch (Exception $e) {
            http_response_code($e->getCode());
            echo json_encode(["Error" => $e->getMessage()]);
        }
    }

    public function verPostsTendencias()
    {
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        $user = Auth::user();
        $auth_user_id = $user['id'];
        try {
            $data = $this->posts->selectPostsLimitByLikes($auth_user_id, $search);
            PostsResources::getResource($data);
        } catch (Exception $e) {
            http_response_code($e->getCode());
            echo json_encode(["Error" => $e->getMessage()]);
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
        $data = $this->posts->selectPostsByUserId($auth_user_id);
        try {
            PostsResources::getResource($data);
        } catch (Exception $e) {
            http_response_code($e->getCode());
            echo json_encode(["Error" => $e->getMessage()]);
        }
    }


    public function verPost($post_id)
    {
        $user = Auth::user();
        $auth_user_id = $user['id'];
        try {
            $data = $this->posts->selectPostById($post_id, $auth_user_id);
            PostsResources::getResource($data);
        } catch (Exception $e) {
            http_response_code($e->getCode());
            echo json_encode(["Error" => $e->getMessage()]);
        }
    }

    public function crearPost()
    {
        $user = Auth::user();
        $auth_user_id = $user['id'];
        $title = isset($_POST['title']) ? $_POST['title'] : '';
        $description = isset($_POST['description']) ? $_POST['description'] : '';

        try {
            $id = $this->posts->insert([
                'title' => $title,
                'description' => $description,
                'user_id' => $auth_user_id
            ]);
            if ($id) {
                $this->fileController->crearFiles($id);
                http_response_code(201);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            echo json_encode(["Error" => $e->getMessage()]);
        }
    }

    public function eliminarPost($post_id)
    {
        $user = Auth::user();
        $auth_user_id = $user['id'];
        try {
            $response = $this->fileController->deleteFiles($post_id);
            $response = $this->posts->deletePost($post_id, $auth_user_id);
            if ($response) {
                http_response_code(204);
                echo json_encode([]);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            echo json_encode(["Error" => $e->getMessage()]);
        }
    }
}
