<?php declare(strict_types = 1); ?>

<?php function drawRestaurant($idRestaurant, $name, $category, $logo) { ?>
    <a href="../pages/profile.php?res=<?php echo($idRestaurant)?>">
        <article>
            <img src=<?php echo("../images/restaurant/small/" . $logo . ".jpg")?>>
            <h2><?=$name;?></h2>
            <h3><?=$category;?></h3>
            <img src="https://thumbs.dreamstime.com/z/imagem-do-%C3%ADcone-de-estrelas-83946136.jpg" width="50" height="50">
        </article>
    </a>
 <?php }?>