<?php

namespace Model;

use PDO;

class Connect
{

    private $pdo;

    public function __construct($host, $db_name, $db_username, $db_password)
    {
        try {
            $this->pdo = new PDO('mysql:host=' . $host . ';dbname=' . $db_name, $db_username, $db_password);
        } catch (PDOException $e) {
            exit('Error Connecting To Database');
        }
    }

    public function executeQuery($query, $params = [])
    {
        try {
            $statement = $this->pdo->prepare($query);
            $statement->execute($params);
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            exit('Error executing query: ' . $e->getMessage());
        }
    }

}