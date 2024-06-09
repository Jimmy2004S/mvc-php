<?php

namespace App\Controllers;



class Controller
{
    public function inicio()
    {
        require_once 'Resources/View/inicio.php';
    }

    public function prueba()
    {
        echo "Prueba controller";
    }
}
