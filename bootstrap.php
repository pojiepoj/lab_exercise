<?php 

require 'vendor/autoload.php';

use Src\System\DatabaseConnector;

$dbConnection = (new DatabaseConnector())->getConnection();