<?php

namespace App\Controllers;

use DataBase\Config\DB;

class Controller
{
    public function home()
    {
        echo "Home";
    }

    public function prueba()
    {
        $db = new DB();
        $db->Connection();
    }
}
