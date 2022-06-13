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
        <script src="/../javascript/favorites.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="../styles/style-search.css">
        <link rel="stylesheet" href="../styles/common.css">
    </head>
    <body>
        <main>
            <section class="manage-grid">
                <?php
                    foreach($results as $restaurant){ 
                        drawRestaurant($restaurant);
                    }
                ?>
            </section>
            <div class="management">
                    <a class="central-button" href='../pages/add_restaurant.php'>Add New Restaurant</a>
            </div>
        </main>
    </body>
</html>

<?=drawFooter();?>