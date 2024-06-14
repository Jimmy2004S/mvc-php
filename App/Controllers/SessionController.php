<?php

namespace App\Controllers;

use App\Model\User;
use Lib\Controller;

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
        list($success, $data , $token) = $this->user->autenticar($email, $clave);
        if ($success === true) {
            if ($data['state'] == '1') {
                $tipo_persona = $this->verificarTipoPersona($data['role_id']);
                $_SESSION['codigo'] = $data['codigo'];
                $_SESSION['email'] = $data['email'];
                $_SESSION['token'] = $data['id'] . "|". $token;
                $_SESSION['nombre'] = $data['nombre'];
                $_SESSION['apellido'] = $data['apellido'];
                $_SESSION['tipo_persona'] = $tipo_persona;
                if ($tipo_persona == 'Estudiante' || $tipo_persona == 'Profesor') {
                    header('Location: /Inicio/inicioView');
                }elseif($tipo_persona == 'Administrador'){
                    header("Location: /AdminController/inicioView");
                }
            }
        }elseif($success === false){
            echo "tenemos error: $data";
        }elseif($success === null){
            $_SESSION['error_login'] = true;
            header("Location: /SessionController/loginView");
        }
    }

    public function logout(){
        $token = $_SESSION['token'];
        $token = explode("|", $token);
        list($success, $data) = $this->user->revocarTokens($token[0]);
        if($success === true){
            session_destroy();
            header("Location: /");
            exit();
        }elseif($success === false){
            echo "tenemos error: $data";
        }

    }

    private function verificarTipoPersona($role_id){
        return $this->user->verificarRole($role_id);
    }
}
