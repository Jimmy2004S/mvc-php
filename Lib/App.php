<?php
session_start();

use App\Controllers\Inicio;
use App\Controllers\SessionController;
use App\Controllers\AdminController;
use Lib\Util\Auth;

class App
{

    private $controllerClass;
    function __construct()
    {
        $uri = $_SERVER['REQUEST_URI']; //dominio/uri
        $uri = trim($uri, '/');
        if (empty($uri)) {
            //Validar que session activa antes de redigirir
            if (Auth::sessionActiva()) {
                if (Auth::habilidad() == 'Administrador') {
                    $this->controllerClass = new AdminController();
                } else {
                    $this->controllerClass = new Inicio();
                }
                $this->controllerClass->inicioView(); //Se lleva al inicio segun la habilidad de la session
            } else {
                $this->controllerClass = new SessionController();
                $this->controllerClass->loginView();
            }
            return;
        }

        $uri = rtrim($uri, '/');
        $uri = explode("/", $uri); // Separar la url controlador/metodo
        $archivoController = "../App/Controllers/" . $uri[0] . ".php";
        //Verificar si el controlador existe
        if (file_exists($archivoController)) {
            $this->middleware($uri);
            require_once $archivoController;
            $controllerClass = "App\Controllers\\" . $uri[0];
            $controller = new $controllerClass();
            //Verificar si el metodo existe
            if (isset($uri[1]) && method_exists($controller, $uri[1])) {
                $controller->{$uri[1]}();
            } else {
                echo "error: No hay metodo $uri[1]";
            }
        } else {
            echo "error: no existe el controlador $uri[0]";
        }
    }


    private function middleware($uri)
    {
        // Verificar autenticacion en las rutas necesarias
        if (isset($uri[1])) {
            if ($uri[1] == "login" || $uri[1] == "loginView" || $uri[1] == "logout") {
                return;
            }
        }
        if (!Auth::sessionActiva()) {
            die("Error de autenticacion");
        }
    }

}
