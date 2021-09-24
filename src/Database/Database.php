<?php

namespace Dentist\Database;

use PDO;
use PDOException;

class Database
{
    private string $userName = "root";
    private  string $serverName = "localhost";
    private string $password = "";
    private string $database = "dentist";
    private string $charset = "utf8mb4";  //default set

    public function connect(): PDO
    {
        try {
            $dns = "mysql:host=$this->serverName;dbname=$this->database;chars=$this->charset;"; //data source name

            $pdo = new PDO(
                $dns,
                $this->userName,
                $this->password
            );
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            echo "CONNECTION FAILED: ". $e->getMessage();
        }
    }

}