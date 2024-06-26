<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once '../Lib/App.php';
use Dotenv\Dotenv;

// Cargar variables de entorno desde el archivo .env
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

date_default_timezone_set($_ENV['TIMEZONE']);
$app = new App();