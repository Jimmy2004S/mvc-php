<?php
namespace Lib;

use DataBase\Config\DB;
use Lib\Util\ModelFormat;

class Model extends DB
{
    use ModelFormat;

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