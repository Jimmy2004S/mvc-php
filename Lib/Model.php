<?php

namespace Lib;

use DataBase\Config\DB;
use Jenyus\Base\DynamicModel;
use Lib\Util\ModelFormat;

class Model extends DynamicModel
{
    use ModelFormat;

    protected $conexion;
    protected $query;
    protected $table;

    public function __construct()
    {
        $this->conexion =  DB::getConnection();
        parent::__construct($this->conexion);
    }

    public function getConexion()
    {
        return $this->conexion;
    }
}
