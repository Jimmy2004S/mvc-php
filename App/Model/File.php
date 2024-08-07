<?php

namespace App\Model;

use Lib\Model;

class File extends Model
{
    
    protected $table = "files";
    public function __construct()
    {
        parent::__construct();
    }

}
