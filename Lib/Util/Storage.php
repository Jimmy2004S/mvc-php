<?php
namespace Lib\Util;

class Storage{
    public function __construct(){
    }

    public static function path($path){
        $path = explode("/", $path);
        if(count($path) >= 3){
            if($path[0] == 'public'){
                array_shift($path);
                return $path[0] . '/' . $path[1];
            }
        }
        return $path;
    }
}