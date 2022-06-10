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
//Array ( [0] => Array ( [idUser] => 60 [idOrder] => 6297c6ca2f781 [date] => 2022-06-01 [total] => 36 [status] => reviewed [name] => Smokey’s Texas Grill ) )
?>

<link rel="stylesheet" href="../styles/style-orders.css">
<script src="/../javascript/order_status.js"></script>

<div class="wrapper">
    <div class="title-wrapper">
        <h1>Your restaurant`s orders</h1>
    </div>
    <table class="orders-table">
        <tbody>
            <?php
            foreach($orders as $row){
                drawOrderRowOwner($row);
            }
            ?>

        </tbody>
    </table>
</div>