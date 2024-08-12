<?php

namespace App\Controllers;

use App\Model\User;
use App\Resources\UserResources;
use Exception;
use Lib\Controller;

class UserController extends Controller
{

    private $user;

    public function __construct()
    {
        $this->user = new User();
        parent::__construct();
    }

    public function index()
    {
        try {
            $users = $this->user->where('role_id', '1', '!=')->get();
            UserResources::getResource($users);
        } catch (Exception $e) {
            http_response_code($e->getCode());
            echo json_encode(["error" => $e->getMessage()]);
        }
    }

}
