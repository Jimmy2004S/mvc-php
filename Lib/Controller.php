<?php 
namespace Lib;

use Lib\View;

class Controller{

    protected $view;
    function __construct()
    {
        $this->view = new View();
    }
}