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

    public function registerView()
    {
        $this->view->render('register');
    }

    public function register()
    {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role = $_POST['role'];
        $bandera = true;

        if ($role === 'Estudiante') {
            $semestre = $_POST['semester'];
            $carrera = $_POST['career'];
            $bandera = false;
        }
        if ($role === 'Profesor') {
            $departamento = $_POST['department'];
        }

        $nombre = explode(' ', $nombre);
        $apellido = explode(' ', $apellido);
        $userName = $nombre[0] . '_' . $apellido[0];


        try {
            $id = $this->user->insert([
                'user_name' => $userName,
                'code' => rand(2023005, 2023999),
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'role_id' => $role === 'Estudiante' ? 1 : 2,
            ]);

            if ($id) {
                if ($bandera == false) {
                    $this->user->SetTable('students');
                    $this->user->insert([
                        'user_id' => $id,
                        'semester' => $semestre,
                        'career' => $carrera
                    ]);
                } else {
                    $this->user->SetTable('teachers');
                    $this->user->insert([
                        'user_id' => $id,
                        'department' => $departamento
                    ]);
                }
            }
            http_response_code(201);
            echo json_encode(['message' => 'created']);
        } catch (\PDOException $e) {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
    public function loginView()
    {
        $this->view->render('login');
    }

    public function login()
    {
        $email = $_POST['email'];
        $clave = $_POST['clave'];
        $token = $this->user->login([
            'email' => $email,
            'password' => $clave
        ]);

        if ($token) {
            $user = $this->user->where('email', $email)->first();
            if ($user['state'] == '1') {
                $tipo_persona = $this->verificarTipoPersona($user['role_id']);
                $_SESSION['code'] = $user['code'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['token'] = $user['id'] . "|" . '121212312';
                $_SESSION['user_name'] = $user['user_name'];
                $_SESSION['tipo_persona'] = $tipo_persona;
                http_response_code(200);
                if ($tipo_persona == 'Estudiante' || $tipo_persona == 'Profesor') {
                    $tipo = lcfirst($tipo_persona);
                    $this->user->generateToken([$tipo, 'user']);
                    echo json_encode(['status' => 'success', 'redirect' => '/inicio']);
                } elseif ($tipo_persona == 'Administrador') {
                    $this->user->generateToken(['admin']);
                    echo json_encode(['status' => 'success', 'redirect' => '/admin/inicio']);
                }
            } else {
                http_response_code(403);
                echo json_encode(['status' => 'Esta cuenta no esta activa']);
            }
        } else {
            http_response_code(401);
            echo json_encode(['status' => 'Error de inicio session']);
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
