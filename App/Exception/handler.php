<?php
namespace App\Exception;

class FileUploadException extends \ErrorException {}

function exception_error_handler($severity, $message, $file, $line) {
    if (!(error_reporting() & $severity)) {
        return;
    }
    throw new FileUploadException($message, 0, $severity, $file, $line);
}
