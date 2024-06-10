<?php

namespace App\Controllers;

use App\Model\User;

class AdminController
{

    private $user;
    public function __construct()
    {
        $this->user = new User();
    }

    public function inicio()
    {
        require_once 'Resources/View/Admin/inicio.php';
    }

    public function verUsuariosView()
    {
        require_once 'Resources/View/Admin/ver-usuarios.php';
    }

    public function verUsuarios()
    {
        list($success, $data) = $this->user->select();
        if ($success) {
            $json = array();
            foreach ($data as $row) {
                $json[] = array(
                    'codigo' => $row['codigo'],
                    'nombre' => $row['nombre'],
                    'apellido' => $row['apellido'],
                    'tipo_persona' => $row['tipo_persona'],
                    'telefono' => $row['telefono'],
                    'email' => $row['email'],
                    'estado' => $row['estado'],
                    'clave' => $row['clave']
                );
            }
            // Convertir a JSON y enviar respuesta al cliente
            http_response_code(200);
            echo json_encode($json);
        } else {
            http_response_code(500);
            echo json_encode(["Error" => $data]); // $data contiene el mensaje de error
        }
    }

    public function cambiarEstadoUsuario(){
        if(isset($_POST['codigo'])){
            $codigo = $_POST['codigo'];
            list($success , $data) = $this->user->cambiarEstadoUsuario($codigo);
            if($success){
                http_response_code(200);
                echo json_encode($data);
            }else{
                http_response_code(500);
                echo json_encode(["Error" => $data]);
            }
        }
    }
}
