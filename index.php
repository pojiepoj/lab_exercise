<?php

require "bootstrap.php";

use Src\Controller\KeyController;

//header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json; charset=UTF-8");
//header("Access-Control-Allow-Methods: GET,POST,PUT");
//header("Access-Control-Max-Age: 3600");
//header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
print($uri);
$uri = explode( '/', $uri );

print_r($uri);

if ($uri[1] !== 'keystore') {
     header("HTTP/1.1 404 Not Found");
     exit();
}

$requestMethod = $_SERVER["REQUEST_METHOD"];

$key = null;

