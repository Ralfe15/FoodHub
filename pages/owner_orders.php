<?php

declare(strict_types=1);

session_start();

require_once(__DIR__ . '/../templates/common.tpl.php');
require_once(__DIR__ . '/../templates/orders.tpl.php');
require_once(__DIR__ . '/../utils/sorting_utils.php');



drawHeader();

require_once(__DIR__ . '/../database/connection.db.php');

if (!isset($_SESSION['id'])) {
    header('Location: http://localhost:9000/pages/login.php');
}

$res = $_GET['res'];
$db = getDatabaseConnection();
$stmt = $db->prepare('select user_order.idUser, user_order.idOrder, user_order.date, user_order.total, user_order.status, restaurant.name from user_order inner join restaurant on user_order.idRestaurant = restaurant.idRestaurant where user_order.idRestaurant = ?');
$stmt -> execute(array($res));
$result = $stmt->fetchAll();
$orders = array();
foreach($result as $order){
    $orders[] = $order;
}
print_r($orders);
die();