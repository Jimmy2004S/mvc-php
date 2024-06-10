<?php
namespace App\Controllers;

use Lib\Controller;


class Inicio extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function inicio()
    {
        $this->view->render('inicio');
    }

    public function prueba()
    {
        echo "Prueba controller";
    }
}
