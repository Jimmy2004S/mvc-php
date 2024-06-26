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

    public function verUsuarios()
    {
        list($success, $data) = $this->user->select();
        if ($success) {
            $json = array();
            foreach ($data as $row) {
                $json[] = array(
                    'id' => $row['id'],
                    'code' => $row['code'],
                    'user_name' => $row['user_name'],
                    'role' => $this->verificarTipoPersona($row['role_id']),
                    'email' => $row['email'],
                    'state' => $row['state'],
                );
            }
            // Convertir a JSON y enviar respuesta al cliente
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

    public function cambiarEstadoUsuario()
    {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            list($success, $data) = $this->user->updateUserState($id);
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
        } else {
            http_response_code(400);
            echo json_encode(["Error" => "ID no proporcionado"]);
        }
    }

    private function verificarTipoPersona($role_id)
    {
        return $this->user->verificarRole($role_id);
    }
}
