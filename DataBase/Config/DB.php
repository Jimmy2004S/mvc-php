<?php 
namespace DataBase\Config;

class DB{
    private $schema;
    private $host;
    private $password;
    private $user;
    private static $instance = null;
    private $pdo;

    private function __construct()
    {
        $this->schema = $_ENV['DATABASE'];
        $this->host = $_ENV['DB_HOST'];
        $this->password = $_ENV['DB_PASS'];
        $this->user = $_ENV['DB_USER'];

        try {
            $this->pdo = new \PDO("mysql:host=$this->host;dbname=$this->schema", $this->user, $this->password);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            throw new \Exception("No se pudo conectar a la base de datos: " . $e->getMessage());
        }
    }

    public static function getConnection()
    {
        if (!self::$instance) {
            self::$instance = new DB();
        }
        return self::$instance->pdo;
    }
}