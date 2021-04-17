<?php

require "bootstrap.php";

use Src\Controller\KeyController;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET,POST,PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

//retrieves server request method
$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($uri[1] !== 'keystore') {
     header("HTTP/1.1 404 Not Found");
     exit();
}

// Takes raw data from the request
$json = file_get_contents('php://input');
$jsonPost = null;
if(!empty($json)){
     $jsonPost = $json;
}

$keyId = null;
if(isset($uri[2])) {
     $keyId = $uri[2];
}

$controller = new KeyController($dbConnection, $requestMethod, $keyId, $jsonPost);
$controller->processRequest();