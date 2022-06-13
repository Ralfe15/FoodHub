<?php

declare(strict_types=1);

session_start();
require_once(__DIR__ . '/../database/connection.db.php');
$db = getDatabaseConnection();

/*
CREATE TABLE Dish_order(
    idOrder varchar(50) NOT NULL REFERENCES User_order(idOrder),
    idDish number NOT NULL REFERENCES Dish(idDish),
    ammount number NOT NULL
);

CREATE TABLE User_order(
    idUser number NOT NULL REFERENCES User(idUser),
    idOrder varchar(50) PRIMARY KEY NOT NULL,
    idRestaurant number NOT NULL REFERENCES Restaurant(idRestaurant),
    date varchar(50) NOT NULL,
    total number NOT NULL,
    status varchar(50) NOT NULL
);
*/

//multiple restaurant orders are NOT ALLOWED and handled in js

if (isset($_SESSION['id'])) {
    $order_id = uniqid();
    $items = json_decode(file_get_contents('php://input'), true);
    $restaurant_id = $items[0]['idRestaurant'];
    $total = floatval($items['total']);
    unset($items['total']);
    //insert row into User_order (create order)
    $stmt = $db->prepare('Insert into User_order (idUser, idOrder, idRestaurant, date, total, status) VALUES (?, ?, ?, ?, ?, ?)');
    $stmt -> execute(array($_SESSION['id'], $order_id, $restaurant_id, date('Y-m-d'), $total, "created"));

    foreach ($items as $dish) {
        $stmt = $db->prepare('Insert into Dish_order (idOrder, idDish, ammount) VALUES (?, ?, ?)');
        $stmt -> execute(array($order_id, $dish['idDish'], $dish['quantity']));
    }
    $response = ['message' => "OK", 'success' => true];
    echo json_encode($response);
}
else{
    $response = ['message' => "Session not set", 'success' => false];
    echo json_encode($response);
}
