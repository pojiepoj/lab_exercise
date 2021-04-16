<?php 

require 'vendor/autoload.php';

use Src\Config\DatabaseConnector;

$dbConnection = (new DatabaseConnector())->getConnection();