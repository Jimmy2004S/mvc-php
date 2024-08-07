<?php

namespace Lib;

abstract class Resources extends Model
{

    protected function jsonResponse($data, $code = 200)
    {
        http_response_code($code);
        echo json_encode($data);
    }

    protected function noContentResponse()
    {
        http_response_code(204);
        echo json_encode([]);
    }

    public static function getResource($data)
    {
        $instance = new static(); // Usar 'static' para late static binding
        if (empty($data)) {
            $instance->noContentResponse();
        } else {
            $instance->processData($data);
        }
    }

    abstract protected function processData($data);
}
