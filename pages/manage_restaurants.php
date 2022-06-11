<?php
declare(strict_types = 1);

session_start();
require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../templates/common.tpl.php');
require_once(__DIR__ . '/../templates/search.tpl.php');

$db = getDatabaseConnection();

$stmt = $db->prepare('Select * from Restaurant where idRestaurant in (select idRestaurant from Restaurant_owner where idUser = ?)');
$stmt->execute(array($_SESSION['id']));
$results = $stmt->fetchAll();


drawHeader();
?>
<html lang="en-US">
    <head>
        <link rel="stylesheet" href="../styles/common.css">
        <link rel="stylesheet" href="../styles/login.css">
    </head>
    <body>
        <main>
            <section class="results-grid">
                <?php
                    foreach($results as $restaurant){ 
                        drawRestaurant($restaurant['idRestaurant'], $restaurant['name'], $restaurant['category'], $restaurant['logo']);
                    }
                ?>
            </section>
            <div class="form">
                    <a class="fcc-btn" href='../pages/add_restaurant.php'>Add New Restaurant</a>
            </div>
        </main>
    </body>
</html>

<?=drawFooter();?>