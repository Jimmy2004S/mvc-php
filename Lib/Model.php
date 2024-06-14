<?php
namespace Lib;

use DataBase\Config\DB;

class Model extends DB
{

    protected $conexion;
    public function __construct()
    {
        $con = new DB();
        $this->conexion = $con->Connection();
    }

    public function getConexion(){
        return $this->conexion;
    }


}