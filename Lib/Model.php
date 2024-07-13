<?php

namespace Lib;

use DataBase\Config\DB;
use Lib\Util\ModelFormat;

class Model extends DB
{
    use ModelFormat;

    protected $conexion;
    protected $query;
    protected $table;

    public function __construct()
    {
        $con = new DB();
        $this->conexion = $con->Connection();
    }

    public function getConexion()
    {
        return $this->conexion;
    }

    public function query($sql)
    {
        $this->query = $this->conexion->query($sql);
        return $this;
    }

    public function first()
    {
        return $this->query->fetch(\PDO::FETCH_ASSOC);
    }

    public function get()
    {
        return $this->query->fetchAll(\PDO::FETCH_ASSOC);
    }

    //Consultas preparadas
    public function all($columns = ['*'])
    {
        // Convertimos el array de columnas a una cadena separada por comas
        $columnsStr = implode(', ', $columns);
        // Construimos la consulta preparada
        $sql = "SELECT {$columnsStr} FROM {$this->table}";
        try {
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            $this->query = $stmt;
            return $this;
        } catch (\PDOException $e) {
            return [false, $e->getMessage()];
        }
    }

    public function where($column, $value, $operator, $columns = ['*'])
    {
        // Convertimos el array de columnas a una cadena separada por comas
        $columnsStr = implode(', ', $columns);
        // Construimos la consulta preparada
        $sql = "SELECT {$columnsStr} FROM {$this->table} WHERE {$column} {$operator} :value";
        try {
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':value', $value, \PDO::PARAM_STR);
            $stmt->execute();
            $this->query = $stmt;
            return [true, $this];
        } catch (\PDOException $e) {
            return [false, $e->getMessage()];
        }
    }

    public function find($value, $columns = ['*'], $operator = '=', $column = 'id')
    {
        // Convertimos el array de columnas a una cadena separada por comas
        $columnsStr = implode(', ', $columns);
        // Construimos la consulta preparada
        $sql = "SELECT {$columnsStr} FROM {$this->table} WHERE {$column} {$operator} :value";
        try {
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':value', $value, \PDO::PARAM_STR);
            $stmt->execute();
            $this->query = $stmt;
            return [true, $this];
        } catch (\PDOException $e) {
            return [false, $e->getMessage()];
        }
    }

    public function insert($columns = [], $values = [])
    {
        // Añadimos created_at a las columnas y su valor correspondiente a los valores
        $columns[] = 'created_at';
        $values[] = $this->basicCurrentFormatDate();

        // Convertimos el array de columnas a una cadena separada por comas
        $columnsStr = implode(', ', $columns);
        // Preparamos las cadenas de valores con los placeholders
        $valuesStr = ':' . implode(', :', $columns);

        $sql = "INSERT INTO {$this->table} ({$columnsStr}) VALUES ({$valuesStr})";
        try {
            $stmt = $this->conexion->prepare($sql);
            // Asignamos los valores a los placeholders
            foreach ($columns as $key => $column) {
                $value = $values[$key];
                $param_type = is_int($value) ? \PDO::PARAM_INT : \PDO::PARAM_STR;
                $stmt->bindValue(':' . $column, $value, $param_type);
            }
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $id = $this->conexion->lastInsertId();
                return [true, $id];
            }
        } catch (\PDOException $e) {
            return [false, $e->getMessage()];
        }
    }



    public function delete($value, $operator = '=', $column = 'id')
    {
        $sql = "DELETE FROM {$this->table} WHERE {$column} {$operator} :value";
        try {
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':value', $value, \PDO::PARAM_STR);
            $stmt->execute();
            return [$stmt->rowCount() > 0, ''];
        } catch (\PDOException $e) {
            return [false, $e->getMessage()];
        }
    }
}
