<?php
namespace Resources;
use App\Controllers\Controller;

class App
{
    function __construct()
    {
        if (isset($_GET["url"])) {
            $url = $_GET["url"];
            $url = rtrim($url, '/');
            $url = explode("/", $url); // Separate every part of the url
            $archivoController = "App/Controllers/" . $url[0] . ".php";
            //Verify the controller exists
            if (file_exists($archivoController)) {
                require_once $archivoController; // Include the controller file
                $controllerClass = "App\Controllers\\" . $url[0];
                $controller = new $controllerClass();
                if (isset($url[1])) { //Verify the method exists
                    $controller->prueba();
                }
            } else {
                $controller = new Controller();
                $controller->home();
            }
        } else {
            $controller = new Controller();
            $controller->home();
        }
    }
}
