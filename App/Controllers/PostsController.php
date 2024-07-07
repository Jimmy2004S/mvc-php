<?php

namespace App\Controllers;

use Lib\Controller;
use App\Model\Posts;
use App\Resources\PostsResources;
use Lib\Util\Auth;
use Lib\Util\Storage;

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
        if (isset($_GET['search'])) {
            $search = $_GET['search'];
        } else {
            $search = '';
        }
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
        if (isset($_GET['search'])) {
            $search = $_GET['search'];
        } else {
            $search = '';
        }
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

    public function listarFilesPosts()
    {
        $post_id = $_GET['post_id'];
        list($success, $data) = $this->posts->selectFilesPosts($post_id);
        if ($success) {
            $json = [];
            foreach ($data as $row) {
                $json[] = [
                    'post_id'           => $row['post_id'],
                    'file_name'           => $row['name'],
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
