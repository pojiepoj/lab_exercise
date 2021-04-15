<?php 

namespace Src\System;

class DatabaseConnector {

    private $dbConnection = null;

    public function __construct()
    {
        $username = "newuser";
        $password = "newuser123!";
        $servername = "localhost";        

        try{
            $conn = new PDO("mysql:host=$servername;dbname=lab_test", $username, $password);

        } catch(PDOException $e){
            
            exit($e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->dbConnection;
    }

}
 
