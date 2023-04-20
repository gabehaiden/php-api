<?php

class Database {
    private $host = "127.0.0.1";
    private $databaseName = "phpapidb";
    private $username = "haiden";
    private $password = "Ghg@1310";
    public $conn;

    public function getConnection()
    {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->databaseName, $this->username, $this->password);
        } catch(PDOException $exception) {
            echo "Database could not be connected: " . $exception->getMessage();
        }
        return $this->conn;
    }
}

?>