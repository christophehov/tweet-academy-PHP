<?php

namespace App\Classes;

use PDO;
use PDOException;

class Database
{

    /**
     * connect
     *
     * @return PDO
     */
    private static function connect(): PDO
    {
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=tweeter;charset=utf8', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    /**
     * @param $query
     * @param array $params
     * @return 
     */
    public static function query($query, array $params = array())
    {
        $statement = self::connect()->prepare($query);
        $statement->execute($params);

        if (explode(' ', $query)[0] == 'SELECT') {
        $data = $statement->fetchAll();
        return $data;
        }
    }


    /**
     * host
     *
     * @var string
     */
    /*private string $host = 'localhost';
    private string $db_name = 'tweeter';
    private string $username = 'root';
    private string $password = '';
    public $conn;

    /**
     * getConnection
     *
     * @return PDO|null $this->conn
     */
    /*public function getConnection()
    {
        $this->conn = null;
        
        try
        {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }
        catch(PDOException $exception)
        {
            echo "Connection error: " . $exception->getMessage();
        }
        
        return $this->conn;
    }*/
}


