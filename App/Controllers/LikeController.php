<?php
namespace App\Controllers;

use App\Model\Like;
use Lib\Controller;
use Lib\Util\Auth;

class LikeController extends Controller{

    private $like;
    public function __construct(){
        parent::__construct();
        $this->like = new Like();
    }

    public function like($post_id){
        $user = Auth::user();
        $user_id = $user['id'];
        list($success, $data) = $this->like->like($post_id, $user_id);
        if($success){
            http_response_code(204);
            echo json_encode([]);
        }elseif($success === false){
            http_response_code(500);
            echo json_encode(["Error" => $data]);
        }
    }
}