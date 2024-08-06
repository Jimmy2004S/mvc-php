<?php
namespace App\Exception;

class NotFoundException extends \Exception{
    public function __construct($message = "Recurso no encontrado", $code = 404, \Exception $previous = null)
    {
        if ($message) {
            $this->message = $message;
        }
        parent::__construct($this->message, $this->code, $previous);
    }
}