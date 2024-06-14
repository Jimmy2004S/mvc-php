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
        $user = $this->user->autenticar($email, $clave);
        if ($user) {
            if ($user['estado'] == 'Activo') {
                $_SESSION['codigo'] = $user['codigo'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['token'] = $user['codigo'] . '123';
                $_SESSION['nombre'] = $user['nombre'];
                $_SESSION['apellido'] = $user['apellido'];
                $_SESSION['tipo_persona'] = $user['tipo_persona'];
                if ($user['tipo_persona'] == 'Estudiante' || $user['tipo_persona'] == 'Profesor') {
                    header('Location: /Inicio/inicioView');
                }elseif($user['tipo_persona'] == 'Administrador'){
                    header("Location: /AdminController/inicioView");
                }
            }
        } else {
            $_SESSION['error_login'] = true;
        header("Location: /SessionController/loginView");
        }
    }

    public function logout(){
        session_destroy();
        header("Location: /");
        exit();
    }
}
