<?php
namespace Lib\Util;

use App\Model\User;

class Auth{

    public static function sessionActiva()
    {
        if (!isset($_SESSION['token']) || $_SESSION['token'] == false ||  empty($_SESSION['token'])) {
            return false;
        }
        return true;
    }

    public static function habilidad()
    {
        if (self::sessionActiva()) {
            return $_SESSION['tipo_persona'];
        }
    }

    public static function user(){
        $token = $_SESSION['token'];
        $token = explode("|", $token);
        $user = new User();
        return $user->userLogueado($token[0]);
    }

}