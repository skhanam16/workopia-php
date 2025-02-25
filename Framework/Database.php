<?php

namespace Framework;

use PDO;
use PDOException;
use Exception;


class Database
{
    public $conn;
    /**
     * Contructor for Database Class
     * @params array $config
     */
    public function __construct($config)
    {
        $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};";

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ];
        try {
            $this->conn = new PDO($dsn, $config['username'], $config['password'], $options);
            // echo "Database is connected";
        } catch (PDOException $e) {
            throw new Exception('Database connection failed: {$e->getMessage()}');
        }
    }

    /**
     * Query the database
     * @param string $query
     * @return PDOStatement
     * @throws PDPException
     * PDPExcetion called this $e
     * $this->conn this is the PDP instance
     */

    public function query($query, $params = [])
    {
        try {
            $sth = $this->conn->prepare($query);

            // Bind named parameters
            foreach ($params as $param => $value) {
                $sth->bindValue(':' . $param, $value);
            }

            $sth->execute();
            return $sth;
        } catch (PDOException $e) {
            throw new Exception("Query execution failed: " . $e->getMessage());
        }
    }
}
