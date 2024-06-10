<?php

namespace Lib;
session_start();

use App\Controllers\Inicio;
use App\Controllers\SessionController;
use App\Controllers\AdminController;

class App
{
    function __construct()
    {
        $url = isset($_GET["url"]) ? $_GET["url"] : false;
        if (!$url) {
            if ($this->sessionActiva()) {
                if ($this->habiliad() == 'Administrador') {
                    $controller = new AdminController();
                    $controller->inicio();
                } else {
                    $controller = new Inicio();
                    $controller->inicio();
                }
            } else {
                $controller = new SessionController();
                $controller->loginView();
            }
            return;
        }
        $url = rtrim($url, '/');
        $url = explode("/", $url); // Separate every part of the url
        $archivoController = "App/Controllers/" . $url[0] . ".php";
        //Verify the controller exists
        if (file_exists($archivoController)) {
            require_once $archivoController; // Include the controller file
            $controllerClass = "App\Controllers\\" . $url[0];
            $controller = new $controllerClass();
            if (isset($url[1]) && method_exists($controller, $url[1])) { //Verify the method exists
                $controller->{$url[1]}();
            } else {
                echo "error: No hay metodo $url[1]";
            }
        } else {
            echo "error: no existe el controlador $url[0]";
        }
    }


    private function middleware($url)
    {
        // if (isset($url[1]) && $url[1] == "login") {
        //     return;
        // }
        // if (isset($url[1]) && $url[1] == "logout") {
        //     return;
        // }
        // if (isset($url[1]) && $url[1] == "loginView") {
        //     return;
        // }
        if (!$this->sessionActiva()) {
            $sessionController = new SessionController();
            $sessionController->loginView();
        }
    }

    private function sessionActiva()
    {
        if (!isset($_SESSION['token']) || $_SESSION['token'] == false ||  empty($_SESSION['token'])) {
            return false;
        }
        return true;
    }

    private function habiliad()
    {
        if ($this->sessionActiva()) {
            return $_SESSION['tipo_persona'];
        }
    }
}
