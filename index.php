<?php

require "bootstrap.php";
use Src\Controller\PersonController;

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

echo "Hello World";