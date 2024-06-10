<?php
namespace Lib;

class View{
    function __construct()
    {
    }

    public function render($view, $data = null){
        require_once "Resources/View/$view.php";
    }
}