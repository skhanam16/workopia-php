<?php

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

    public function query($query)
    {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
            $listing = $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new EXception("Failed to fetch data from the database: {$e->getMessage()}");
        }
    }
}
