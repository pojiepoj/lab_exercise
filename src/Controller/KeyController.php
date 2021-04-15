<?php

namespace Src\Controller;

class KeyController {

    private $db;
    private $requestMethod;
    private $keyValue;

    private $personGateway;

    public function ___construct($db, $requestMethod,$keyValue)
    {
        $this->db = $db;
        $this->requestMethod =  $requestMethod;
        $this->keyValue = $keyValue;
    }
    
    public function processRequest()
    {

    }

}