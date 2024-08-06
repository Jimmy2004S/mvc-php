<?php
namespace App\Exception;

class ForbiddenException extends \Exception{
    public function __construct($message = "No tienes permisos para esta realizar accion", $code = 403, \Exception $previous = null)
    {
        if ($message) {
            $this->message = $message;
        }
        parent::__construct($this->message, $this->code, $previous);
    }
}