<?php

declare(strict_types=1);

session_start();
require_once(__DIR__ . '/../database/connection.db.php');
$db = getDatabaseConnection();


if (isset($_SESSION['id'])) {
    $items = json_decode(file_get_contents('php://input'), true);
    $id = strval($items['id']);

    $stmt = $db->prepare('INSERT into Favorite_dishes (idUser, idDish) values (?, ?)');
    if($stmt -> execute(array($_SESSION['id'], $id))){
    }

    $response = ['message' => "OK", 'success' => true];
    echo json_encode($response);
}
else{
    $response = ['message' => "Session not set", 'success' => false];
    echo json_encode($response);
}

