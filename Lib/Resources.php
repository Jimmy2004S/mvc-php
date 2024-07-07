<?php

namespace Lib;

class Resources extends Model
{

    protected function jsonResponse($data, $code = 200)
    {
        http_response_code($code);
        echo json_encode($data);
    }

    public static function getResource($data)
    {
        // Método abstracto, para ser implementado por las clases hijas
        throw new \Exception("Method getResource() must be implemented by the subclass");
    }
}
