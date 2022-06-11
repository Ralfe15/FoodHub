<?php 
declare(strict_types = 1);
session_start();

require_once(__DIR__ . '/../templates/common.tpl.php');
require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../templates/search.tpl.php');

$db = getDatabaseConnection();

$res = "%{$_POST['search']}%";
$stmt = $db->prepare('Select * from Restaurant where name LIKE ?');
$stmt->execute(array($res));
$results = $stmt->fetchAll();
?>

<?=drawHeader();?>
<html lang="en-US">
    <head>
        <link rel="stylesheet" href="../styles/style-search.css">
    </head>
    <body>
        <div id="search-div">
            <form action="/../pages/search.php" id="search" method = "POST">
                <input type="text" placeholder="Showing results for: <?= $_POST['search'];?>" name="search">
                <button type="submit" class="search-button"><i></i>&#x276F</button>
            </form>
        </div>
        <main>
            <section class="results-grid">
                <?php
                foreach($results as $restaurant){ 
                    drawRestaurant($restaurant['idRestaurant'], $restaurant['name'], $restaurant['category'], $restaurant['logo']);
                }
                ?>
            </section>
        </main>
    </body>
</html>
<?=drawFooter();?>
