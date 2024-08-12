<?php

namespace App\Controllers;

use App\Model\User;
use Lib\Controller;

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

    public function verUsuario()
    {
        if (isset($_POST['codigo'])) {
            $codigo = $_POST['codigo'];
            list($success, $data) = $this->user->selectByCodigo($codigo);
            if ($success === null) {
                http_response_code(404);
                echo json_encode(["No fue encontrado"]);
            }
            if ($success) {
                http_response_code(200);
                echo json_encode($data);
            } else {
                http_response_code(500);
                echo json_encode($data);
            }
        }
    }

    public function cambiarEstadoUsuario($user_id)
    {
        list($success, $data) = $this->user->updateUserState($user_id);
        if ($success === true) {
            http_response_code(200);
            echo json_encode($data);
        } elseif ($success === false) {
            http_response_code(500);
            echo json_encode(["Error" => $data]);
        } else {
            http_response_code(400);
            echo json_encode(["Error" => "Solicitud no válida"]);
        }
    }
}
