<?php
namespace App\Controllers;

class AdminController {
    public function inicio(){
        require_once 'Resources/View/Admin/inicio.php';
    }

    public function verUsuarios(){
        require_once 'Resources/View/Admin/ver-usuarios.php';
    }
}