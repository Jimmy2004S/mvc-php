<?php
spl_autoload_register( function($class){
    echo str_replace("\\" , "/" , $class. ".php") . " - <br>";
    require_once str_replace("\\" , "/" , $class. ".php");
});