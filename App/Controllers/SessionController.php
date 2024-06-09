<?php

namespace App\Controllers;

use App\Model\User;

class SessionController
{

    private $user;
    public function __construct()
    {
        $this->user = new User();
    }

    public function loginView()
    {
        include_once 'Resources/View/login.php';
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
                if ($user['tipo_persona'] == 'Estudiante' || $user['tipo_persona'] == 'Profesor') {
                    header('Location: ?url=Controller/inicio');
                }
            }
        } else {
            $_SESSION['error_login'] = true;
            header("Location: ?url=SessionController/loginView");
        }
    }

    public function logout(){
        session_destroy();
        header("Location: ?url=SessionController/loginView");
    }
}
