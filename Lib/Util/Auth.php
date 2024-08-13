<?php

namespace Lib\Util;

use App\Model\User;
use Exception;

class Auth
{

    private $id;
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
            try{
                $response = $user->find($token[0]);
                if($response){
                    return $response;
                }else{
                    return false;
                }
            }catch(Exception $e){
                http_response_code($e->getCode());
                echo json_encode(["error" => $e->getMessage()]);
            }
        }else{
            return false;
        }
    }
}
