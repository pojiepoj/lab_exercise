<?php 

use \Src\Config\DatabaseConnector;
use \Src\Controller\KeyController;

class KeyStoreTest extends \PHPUnit\Framework\TestCase
{
     public function testDBInstance()
     {
          $dbconn = new DatabaseConnector();                   
          $this->assertInstanceOf("Src\Config\DatabaseConnector",$dbconn);
     }

     public function testControllerInstance()
     {
          $dbconn = new KeyController(null,null,null,null);                   
          $this->assertInstanceOf("Src\Controller\KeyController",$dbconn);
     }

     public function testAddKey()
     {
         $jsonPost = '{"mykey":"testingkey123","value":"this is a test"}';
         $requestMethod ="POST";
         $keyId = null;
  
         $dbConnection = (new DatabaseConnector())->getConnection();
         $controller = new KeyController($dbConnection, $requestMethod, $keyId, $jsonPost);
         $jsonReturn = $controller->processRequest();
         $data = json_decode($jsonReturn, true);
         $this->assertArrayHasKey('mykey', $data);         
     }

     public function testGetKey()
     {
         $jsonPost = null;
         $requestMethod ="GET";
         $keyId = "testingkey123?timestamp=1618833154";
  
         $dbConnection = (new DatabaseConnector())->getConnection();
         $controller = new KeyController($dbConnection, $requestMethod, $keyId, $jsonPost);
         $jsonReturn = $controller->processRequest();
         $data = json_decode($jsonReturn, true);
         $this->assertArrayHasKey('mykey', $data);
     } 

     public function testGetKeyTimestamp()
     {
         $jsonPost = null;
         $requestMethod ="GET";
         $keyId = "testingkey123";
  
         $dbConnection = (new DatabaseConnector())->getConnection();
         $controller = new KeyController($dbConnection, $requestMethod, $keyId, $jsonPost);
         $jsonReturn = $controller->processRequest();
         $data = json_decode($jsonReturn, true);
         $this->assertArrayHasKey('mykey', $data);
     }    

     public function testGetAllKey()
     {
         $jsonPost = null;
         $requestMethod ="GET";
         $keyId = "get_all_records";
  
         $dbConnection = (new DatabaseConnector())->getConnection();
         $controller = new KeyController($dbConnection, $requestMethod, $keyId, $jsonPost);
         $jsonReturn = $controller->processRequest();
         $data = json_decode($jsonReturn, true);
         $this->assertArrayHasKey('mykey', $data[0]);
     }    

}