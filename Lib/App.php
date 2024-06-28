<?php
session_start();

use App\Controllers\HomeController;
use App\Controllers\SessionController;
use App\Controllers\AdminController;
use Lib\Util\Auth;
use Routes\Api;
use Routes\Web;

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
                    $this->controllerClass = new HomeController();
                }
                $this->controllerClass->inicioView(); //Se lleva al inicio segun la habilidad de la session
            } else {
                $this->controllerClass = new SessionController();
                $this->controllerClass->loginView();
            }
            return;
        }

        $uri = rtrim($uri, '/');
        //Obtener las rutas
        $routes = ( $this->isApiRequest() ) ? new Api() : new Web();
        $route = $routes->getRoute($uri);

        $archivoController = "../App/Controllers/" . $route['controller'] . ".php";
        //Verificar si el controlador existe
        if (file_exists($archivoController)) {
            $this->middleware($route['method']);
            require_once $archivoController;
            $controllerClass = "App\Controllers\\" .  $route['controller'];
            $controller = new $controllerClass();
            //Verificar si el metodo existe
            if (isset($route['method']) && method_exists($controller, $route['method'])) {
                $controller->{$route['method']}();
            } else {
                echo "error: No hay metodo " . $route['method'];
            }
        } else {
            echo "error: no existe el controlador " . $route['controller'];
        }
    }


    private function middleware($method)
    {
        // Verificar autenticacion en las rutas necesarias
        if (isset($method)) {
            if ($method == "login" || $method == "loginView" || $method == "logout" || $method == "logueado") {
                return;
            }
        }
        if (!Auth::sessionActiva()) {
            die("Error de autenticacion");
        }
    }

    private function isApiRequest()
    {
        return strpos($_SERVER['REQUEST_URI'], '/api/') === 0;
    }
}
