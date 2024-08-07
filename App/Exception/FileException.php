<?php
namespace App\Exception;

use Exception;

class FileException extends Exception{

    public function __construct($message = 'Ha ocurrido un error al tratar de acceder o algun directorio o archivo', $code = 500, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}