<?php
namespace Lib;

use DataBase\Config\DB;

class Model
{

    protected $conexion;
    public function __construct()
    {
        $con = new DB();
        $this->conexion = $con->Connection();
    }


}