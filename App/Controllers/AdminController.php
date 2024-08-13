<?php

namespace App\Controllers;

use App\Model\User;
use Lib\Controller;
use PDOException;

class AdminController extends Controller
{

    private $user;
    public function __construct()
    {
        parent::__construct();
        $this->user = new User();
    }

    public function inicioView()
    {
        $this->view->render('admin/inicio');
    }

    public function verUsuariosView()
    {
        $this->view->render('admin/ver-usuarios');
    }

    public function cambiarEstadoUsuario($user_id)
    {

        try{
            $response = $this->user->updateUserState($user_id);
            if($response){
                http_response_code(204);
                echo json_encode([]);
            }else{
                http_response_code(500);
                echo json_encode(["Error" => "Error al cambiar el estado"]);
            }
        }catch(PDOException $e){
            http_response_code($e->getCode());
            echo json_encode(["Error" => $e->getMessage()]);
        }

    }
}
