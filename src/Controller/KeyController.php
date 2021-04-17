<?php

namespace Src\Controller;

use Src\Repository\KeyRepository;

class KeyController {

    private $db;
    private $requestMethod;
    private $keyValue;
    private $jsonPost;
    private $keyrepository;

    public function __construct($conn, $method,$kvalue, $jsonPost)
    {        
        $this->db = $conn;
        $this->requestMethod =  $method;
        $this->keyValue = $kvalue;
        $this->jsonPost = $jsonPost;
        $this->keyrepository = new KeyRepository($conn);
    }

    /**
     * Function to process all request method
     */
    public function processRequest()
    {        
        switch ($this->requestMethod) {
            case 'GET':                
                if (strtolower($this->keyValue) != "get_all_records") 
                {
                    $response = $this->getKey($this->keyValue);
                    echo $response;                
                } 
                else if(strtolower($this->keyValue) == "get_all_records") 
                {
                    
                    $response = $this->getAllKey();
                    echo $response;                
                }                               
                break;

            case 'POST':                
                if($this->jsonPost){
                    $jdecode = json_decode($this->jsonPost, true);
                    if(array_key_exists("mykey",$jdecode) && array_key_exists("value",$jdecode)){
                        $response = $this->insertUpdateKey($jdecode); 
                        echo $response;
                    }else{
                      echo "json key mykey or value doesnt exist";
                    }
                }else{
                    //If no json pass, randomly generate a key and value.
                    $response = $this->generateKey();                       
                    echo $response;
                }
                break;

            default:
                $response = $this->notFoundResponse();                       
                echo $response;
                break;
        }
    }

    private function generateKey()    
    {
        $key = md5(uniqid());
        $value = "initial create of key";
        $input['mykey'] = $key;
        $input['value'] = $value;        

        $res = $this->keyrepository->insert($input);        

        return json_encode($res);
    }

    private function insertUpdateKey(Array $input) 
    {        
        $check = $this->keyrepository->checkKeyExist($input['mykey']);   
        if ($check) {
            $history = $this->keyrepository->insertHistory($input['mykey']);
            if($history) {                
                $res = $this->keyrepository->update($input);
                return json_encode($res);
            }else{
                $res["status"] = "Unable to save history";
                return json_encode($res);
            }            
        } else {
            $res = $this->keyrepository->insert($input);
            return json_encode($res);
        }        
    }

    private function getKey($key)
    {
        $res = $this->keyrepository->find($key);   

        if (! $res) {
            return $this->notFoundResponse();
        }

        return json_encode($res);
    }    

    private function getAllKey(){
        
        $res = $this->keyrepository->getAll();
        
        if (! $res) {
            return $this->notFoundResponse();
        }
        
        return json_encode($res);
    }        

    private function notFoundResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = null;
        return json_encode($response);
    }

}