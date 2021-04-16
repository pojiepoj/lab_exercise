<?php

namespace Src\Controller;

use Src\Repository\KeyRepository;

class KeyController {

    private $db;
    private $requestMethod;
    private $keyValue;

    private $keyrepository;

    public function ___construct($db, $requestMethod,$keyValue)
    {
        $this->db = $db;
        $this->requestMethod =  $requestMethod;
        $this->keyValue = $keyValue;

        $this->keyrepository = new KeyRepository($db);
    }
    
    public function processRequest()
    {
        switch ($this->requestMethod) {
            default:
                break;
        }
    }

}