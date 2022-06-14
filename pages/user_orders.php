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

$db = getDatabaseConnection();
$stmt = $db->prepare('select user_order.rowid, user_order.idUser, user_order.idOrder, user_order.date, user_order.total, user_order.status, restaurant.name from user_order inner join restaurant on user_order.idRestaurant = restaurant.idRestaurant where idUser = ?');
$stmt -> execute(array($_SESSION['id']));
$result = $stmt->fetchAll();
$orders = array();
foreach($result as $order){
    $orders[] = $order;
}

//sort orders (recent first)
usort($orders, 'rowid_compare');


?>
<link rel="stylesheet" href="../styles/style-orders.css">
<div class="wrapper">
    <div class="title-wrapper">
        <h1>Your orders</h1>
    </div>
    <table class="orders-table">
        <tbody>
            <?php
            foreach($orders as $row){
                drawOrderRow($row);
            }
            ?>

        </tbody>
    </table>
</div>
<?php drawFooter()?>
