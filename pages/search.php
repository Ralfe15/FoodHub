<?php 
declare(strict_types = 1);
session_start();

require_once(__DIR__ . '/../templates/common.tpl.php');
require_once(__DIR__ . '/../database/connection.db.php');

$db = getDatabaseConnection();

$res = "%{$_POST['search']}%";
$stmt = $db->prepare('Select * from Restaurant natural join Review where name LIKE ?');
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
                <input type="text" placeholder="Search.." name="search">
                <button type="submit" class="search-button"><i></i>&#x276F</button>
            </form>
        </div>
        <main>
            <section id="results-grid">
                <?php
                foreach($results as $restaurant)
                {
                ?>
                    <a href="../pages/profile.php?res=<?php echo($restaurant['idRestaurant'])?>">
                        <article>
                            <img src="https://www.citypng.com/public/uploads/preview/-11600735522qbwj7xtpxu.png" width="50" height="50">
                            <h2><?=$restaurant['name'];?></h2>
                            <h3><?=$restaurant['category'];?></h3>
                            <img src="https://thumbs.dreamstime.com/z/imagem-do-%C3%ADcone-de-estrelas-83946136.jpg" width="50" height="50">
                        </article>
                    </a>
                <?php }
                ?>
            </section>
        </main>
    </body>
</html>
<?=drawFooter();?>
