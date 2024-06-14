<?php 
namespace App\Model;

use Lib\Model;

class Proyectos extends Model{
    public function __construct()
    {
        parent::__construct();
    }

    public function selectProyectos($codigoPersonaLogueada){
        $sql = "SELECT * FROM";
    }
}