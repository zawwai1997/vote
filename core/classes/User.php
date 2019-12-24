<?php

/* error_reporting(0);
ini_set('display_errors', 0); */

class User {
    protected $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function login($table, $nameAtt, $name)
    {
        $query = "SELECT * FROM $table WHERE $nameAtt = :name";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->rowCount();
    }

    public function checkInput($data)
    {
        $data = trim($data);
        $data = htmlspecialchars($data);
        $data = stripcslashes($data);
        return $data;
    } 
    public function insert($data)
    {
        
        $query = "INSERT INTO `person`(`generate_code`) VALUES ('$data')";

        $stmt = $this->pdo->prepare($query);
    
        $stmt->execute();

        return $stmt->rowCount();
    }   
}