<?php declare(strict_types = 1); ?>

<?php function drawDish($image, $name, $price, $category, $dish) { ?>
    <script src = "../javascript/sidenav.js"></script>
    <article>
        <img src="<?=$image?>">
        <h2 class="dish"><?=ucfirst($name)?></h2>
        <h4 class="dish_category"><?=ucfirst($category)?></h5>
        <h3 class="dish_price"><?="$ ".strval($price).",00"?></h3>
        <?php if(isset($_SESSION['id'])){?>
            <a class="fcc-btn" onclick='addToCart(<?=json_encode($dish);?>)'>Add to cart</a>
        <?php }?>
    </article>
 <?php }?>