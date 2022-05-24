<?php 

//Futuramente transformar isso em função com o tipo de imagem como parametro, função é chamada a partir de outra página

declare(strict_types = 1);
session_start();

require_once(__DIR__ . '/../templates/common.tpl.php');
require_once(__DIR__. '/../database/connection.db.php');

$db = getDatabaseConnection();

$dish = 3;
$stmt = $db->prepare('Select * from Dish where idDish = ?');
$stmt->execute(array($dish));
$image = $stmt->fetch()['photo'];

drawHeader();
?>
<html>
    <head>
        <link rel="stylesheet" href="../styles/style-landing.css">
    </head>
    <body>
        <nav>
            <form action="../actions/action_upload_image_dish.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="dish" value="<?=$dish?>">
                <input type="file" name="image">
                <input type="submit" value="Upload">
            </form>
        </nav>
        <nav class="images">
            <a href="../pages/view_image.php?type=dish&id=<?=$image?>">
                <img src="../images/dishes/<?=$image?>.jpg" width="200" height="200">
            </a>
        </nav>
    </body>
</html>
<?php
drawFooter();
?>
