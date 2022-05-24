<?php
session_start();
require_once(__DIR__ . '/../templates/common.tpl.php');

/*
$res=1;
$stmt = $db->prepare('Select * from Restaurant where name idRestaurant = (select idRestaurant from Restaurant_owner where idUser = ?)');
$stmt->execute(array($res));
$results = $stmt->fetchAll();
*/

drawHeader();
?>
<html lang="en-US">
    <head>
        <link rel="stylesheet" href="../styles/style-search.css">
        <link rel="stylesheet" href="../styles/login.css">
    </head>
    <body>
        <main>
            <section id="results-grid">
                <div class="form-login">
                    <a class="fcc-btn" href='../pages/add_restaurant.php'>Add New Restaurant</a>
                </div>
                <?php
                /*
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
                */?>
            </section>
        </main>
    </body>
</html>

<?=drawFooter();?>