<?php

namespace App\Controllers;

use App\Model\User;
use Lib\Controller;
use Lib\Util\Auth;

class SessionController extends Controller
{

    private $user;
    public function __construct()
    {
        parent::__construct();
        $this->user = new User();
    }

    public function loginView()
    {
        $this->view->render('login');
    }

    public function login()
    {
        $email = $_POST['email'];
        $clave = $_POST['clave'];
        list($success, $data, $token) = $this->user->autenticar($email, $clave);
        if ($success === true) {
            if ($data['state'] == '1') {
                $tipo_persona = $this->verificarTipoPersona($data['role_id']);
                $_SESSION['code'] = $data['code'];
                $_SESSION['email'] = $data['email'];
                $_SESSION['token'] = $data['id'] . "|" . $token;
                $_SESSION['user_name'] = $data['user_name'];
                $_SESSION['tipo_persona'] = $tipo_persona;
                http_response_code(200);
                if ($tipo_persona == 'Estudiante' || $tipo_persona == 'Profesor') {
                    echo json_encode(['status' => 'success', 'redirect' => '/Inicio/inicioView']);
                } elseif ($tipo_persona == 'Administrador') {
                    echo json_encode(['status' => 'success', 'redirect' => '/AdminController/inicioView']);
                }
            }
        } elseif ($success === false) {
            http_response_code(500);
            echo "Error: " . $data;
        } elseif ($success === null) {
            http_response_code(401);
            echo "Error de inicio de sesión";
        }
    }

    public function logout()
    {
        $token = $_SESSION['token'];
        $token = explode("|", $token);
        list($success, $data) = $this->user->revocarTokens($token[0]);
        if ($success === true) {
            session_destroy();
            header("Location: /");
            exit();
        } elseif ($success === false) {
            echo "tenemos error: $data";
        }
    }

    private function verificarTipoPersona($role_id)
    {
        return $this->user->verificarRole($role_id);
    }

    public function logueado()
    {
        $user = Auth::user();
        if (!$user) {
            http_response_code(401);
            echo json_encode("Error de inicio de sesion");
            exit();
        }
        http_response_code(200);
        echo json_encode($user);
    }
}
