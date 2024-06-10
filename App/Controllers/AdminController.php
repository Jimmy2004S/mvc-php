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

    public function inicio()
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

    public function verUsuario(){
        if(isset($_POST['codigo'])){
            $codigo = $_POST['codigo'];
            list($success, $data) = $this->user->selectByCodigo($codigo);
            if($success === null){
                http_response_code(404);
                echo json_encode(["No fue encontrado"]); // $data contiene el mensaje de error
            }
            if($success){
                $json = array();
                foreach($data as $row){
                    http_response_code(404);
                    echo json_encode([$row]); // $data contiene el mensaje de error
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
                http_response_code(200);
                echo json_encode($json);
            }else{
                http_response_code(500);
                echo json_encode($data);
            }
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
