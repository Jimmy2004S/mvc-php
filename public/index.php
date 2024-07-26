<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../Lib/App.php';
require_once __DIR__ . '/../App/Exception/handler.php';

// Asegúrate de que la función esté definida antes de llamarla
set_error_handler('App\Exception\exception_error_handler');

use Dotenv\Dotenv;

// Cargar variables de entorno desde el archivo .env
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

date_default_timezone_set($_ENV['TIMEZONE']);
$app = new App();
