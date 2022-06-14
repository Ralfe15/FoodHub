<?php

declare(strict_types=1);

session_start();

require_once(__DIR__ . '/../templates/common.tpl.php');
require_once(__DIR__ . '/../templates/restaurant.tpl.php');

drawHeader();

require_once(__DIR__ . '/../database/connection.db.php');

if (!isset($_SESSION['id'])) {
    header('Location: http://localhost:9000/pages/login.php');
}

$db = getDatabaseConnection();
$stmt = $db->prepare('select * from Favorite_dishes join dish on Favorite_dishes.idDish = dish.idDish where idUser=?;');
$stmt->execute(array($_SESSION['id']));
$result = $stmt->fetchAll();
$restaurants = array();

?>
<link rel="stylesheet" href="../styles/style-profile.css">
<link rel="stylesheet" href="../styles/style-review.css">
<link rel="stylesheet" href="../styles/common.css">
<script src="/../javascript/favorites.js"></script>
<div class="content-wrapper">
    <div class="title-wrapper">
        <h1 style="margin-left: 2em">Your favorite dishes</h1>
    </div>
    <section id="highlights">
        <?php
        foreach ($result as $dish) {
            drawFavoriteDish($dish, 'true');
        }
        ?>
    </section>
</div>