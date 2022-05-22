<?php 
declare(strict_types = 1);
session_start();

require_once(__DIR__ . '/../templates/common.tpl.php');
require_once(__DIR__. '/../database/connection.db.php');

$db = getDatabaseConnection();

$stmt = $db->prepare('Select * from Img');
//Descobrir como resolver o erro que dá por Img ser vazia
$stmt->execute();

$images = $stmt->fetchAll();

drawHeader();
?>
<html>
    <head>
        <link rel="stylesheet" href="../styles/style-landing.css">
    </head>
    <body>
        <nav>
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <label>Title:
                <input type="text" name="title">
                </label>
                <input type="file" name="image">
                <input type="submit" value="Upload">
            </form>
        </nav>
        <section id="images">
        <?php foreach ($images as $image) { ?>
        <article class="image">
            <header><h2><?=$image['title']?></h2></header>
            <a href="../pages/view_image.php?id=<?=$image['id']?>">
            <img src="../images/<?=$image['id']?>.jpg" width="200" height="200">
            </a>
        </article>
        <?php } ?>
        </section>
    </body>
</html>
<?php
drawFooter();
?>
