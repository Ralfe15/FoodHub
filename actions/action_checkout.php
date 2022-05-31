<?php 
declare(strict_types = 1);

session_start();
require_once(__DIR__ . '/../database/connection.db.php');
$db = getDatabaseConnection();

    $glauber = json_decode(file_get_contents('php://input'),true);
    // print_r($glauber);
    foreach($glauber as $dish){
        print_r($dish);
    }
