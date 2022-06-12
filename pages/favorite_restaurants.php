<?php

declare(strict_types=1);

session_start();

require_once(__DIR__ . '/../templates/common.tpl.php');
require_once(__DIR__ . '/../templates/search.tpl.php');

drawHeader();

require_once(__DIR__ . '/../database/connection.db.php');

if (!isset($_SESSION['id'])) {
    header('Location: http://localhost:9000/pages/login.php');
}

$db = getDatabaseConnection();
$stmt = $db->prepare('select * from Favorite_restaurants join restaurant on Favorite_restaurants.idRestaurant = restaurant.idRestaurant where idUser=?;');
$stmt->execute(array($_SESSION['id']));
$result = $stmt->fetchAll();
$restaurants = array();
foreach ($result as $restaurant) {
    $restaurants[] = $restaurant;
}


?>
    <link rel="stylesheet" href="../styles/style-search.css">
<script src="/../javascript/favorites.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="wrapper">
    <div class="title-wrapper">
        <h1 style="margin-left: 2em">Your favorite restaurants</h1>
    </div>
    <section class="results-grid">
        <?php
        foreach ($restaurants as $restaurant) {
           drawRestaurant($restaurant);
        }
        ?>
</section>
</div>