<?php

namespace Src\Config;

class DatabaseConnector 
{
    private $dbConnection = null;

    public function __construct()
    {
        $username = "newuser";
        $password = "password123!";
        $servername = "localhost";        

        try{

            $this->dbConnection = new \PDO("mysql:host=$servername;dbname=lab_test", $username, $password);

        } catch(\PDOException $e){
            
            exit($e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->dbConnection;
    }
}