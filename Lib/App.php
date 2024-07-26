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

    private $controllerInstance;

    function __construct()
    {
        $this->handleRequest();
    }

    function handleRequest()
    {
        $uri = $_SERVER['REQUEST_URI']; //dominio/uri
        $uri = trim($uri, '/');
        if (empty($uri)) {
            $this->handleDefaultRoute();
            return;
        }

        $routes = ($this->isApiRequest()) ? new Api() : new Web();
        list($route, $routeDetails, $params) = $routes->getRoute($uri); // Usamos el método del trait
        if ($route) {
            // Validar que session activa antes de llamar al método del controlador
            $this->middleware($route);
            $this->invokeControllerMethod($routeDetails, $params);
        } else {
            $this->showError("404 Not Found");
        }
    }


    private function invokeControllerMethod($routeDetails, $params)
    {
        $controllerClass = "App\\Controllers\\" . $routeDetails['controller'];
        $method = $routeDetails['method'];
        if (class_exists($controllerClass)) {
            $this->controllerInstance = new $controllerClass();
            if (method_exists($this->controllerInstance, $method)) {
                // Llamar al método del controlador con los parámetros extraídos
                call_user_func_array([$this->controllerInstance, $method], $params);
            } else {
                $this->showError("Method $method not found in $controllerClass");
            }
        } else {
            $this->showError("Controller class $controllerClass not found");
        }
    }

    private function handleDefaultRoute()
    {
        //Validar que session activa antes de redigirir
        if (Auth::sessionActiva()) {
            $this->controllerInstance = Auth::habilidad() === 'Administrador' ? new AdminController() : new HomeController();
            $this->controllerInstance->inicioView();
        } else {
            $this->controllerInstance = new SessionController();
            $this->controllerInstance->loginView();
        }
    }

    private function middleware($route)
    {
        // Verificar autenticacion en las rutas necesarias
        if (isset($route)) {
            if ($route == "api/login" || $route == "login" || $route == "api/logueado" || $route == "register" || $route == "api/user/create") {
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

    private function showError($message)
    {
        echo "Error: $message";
    }
}
