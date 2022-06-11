<?php declare(strict_types = 1); ?>

<?php function drawDish($dish) { 
    $isowner = isOwner($dish['idRestaurant']);?>
    <script src = "../javascript/sidenav.js"></script>
    <article>
        <img src="../images/dish/medium/<?=$dish['photo']?>.jpg">
        <h2 class="dish"><?=ucfirst($dish['name'])?></h2>
        <h4 class="dish_category"><?=ucfirst($dish['category'])?></h5>
        <h3 class="dish_price"><?="$ ". $dish['price']?></h3>
        <?php
            if($isowner){ ?>
                <div class="form">
                    <a class="central-button" href='../pages/edit_dish.php?dish=<?=$dish['idDish']?>'>Edit dish</a>
                </div>
            <?php }
            if(isset($_SESSION['id'])){?>
                <button class="fcc-btn buy-button" onclick='addToCart(<?=json_encode($dish);?>)'>Add to cart</button>
        <?php }?>
    </article>
 <?php }?>


 <?php function isOwner($idRestaurant) : bool{ 
    if(!isset($_SESSION['id'])){return false;}
    require_once(__DIR__ . '/../database/connection.db.php');
    
    $db = getDatabaseConnection();

    $stmt = $db->prepare('Select * from Restaurant_owner where idRestaurant = ?');
    $stmt->execute(array($idRestaurant));
    $owners = $stmt->fetchAll();
    $isowner = false;
    foreach($owners as $owner){
        if($_SESSION['id'] == $owner['idUser']){
            $isowner = true;
        }
    }

    return $isowner;
}?>