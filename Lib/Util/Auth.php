<?php

namespace Lib\Util;

use App\Model\User;

class Auth
{

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

    public static function user()
    {
        if (self::sessionActiva()) {
            $token = $_SESSION['token'];
            $token = explode("|", $token);
            $user = new User();
            list($success, $data) = $user->selectById($token[0]);
            if ($success) {
                return $data;
            }
        }else{
            return false;
        }
    }
}
