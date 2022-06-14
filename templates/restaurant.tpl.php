<?php

declare(strict_types=1); ?>

<?php function drawDish($dish, $isfav)
{
    $isowner = isOwner($dish['idRestaurant']); ?>
    <script src="../javascript/sidenav.js"></script>
    <article>
        <img src=<?php echo ($dish['photo'] != null) ? "../images/dish/small/" . $dish['photo'] . ".jpg" : 'https://picsum.photos/200/200?business?id=' . $dish['idDish'] ?>>
        <h2 class="dish"><?= ucfirst($dish['name']) ?>
            <?php if ($isowner) { ?>
                <a href='../pages/edit_dish.php?dish=<?= $dish['idDish'] ?>'>
                    <i class="fa fa-pencil" style="margin-left:5px" aria-hidden="true"></i>
                </a>
            <?php } ?>
            <?php if ($isfav == 'false') { ?>
                <a id=<?= "toggle" . $dish['idDish'] ?> onclick="toggleFavoriteDish('<?= $dish['idDish'] ?>', '<?= $isfav ?>')">
                    <i id="star-icon<?=$dish['idDish']?>" style='float:right' class="fa fa-star-o" aria-hidden="true"></i>
                </a>
            <?php } else { ?>
                <a id=<?= "toggle" . $dish['idDish'] ?> onclick="toggleFavoriteDish('<?= $dish['idDish'] ?>', '<?= $isfav ?>')">
                    <i id="star-icon<?=$dish['idDish']?>" style='float:right' class="fa fa-star" aria-hidden="true"></i>
                </a>
            <?php } ?>
        </h2>
        <h4 class="dish_category"><?= ucfirst($dish['category']) ?></h5>
            <h3 class="dish_price"><?= "$ " . number_format(floatval($dish['price']), 2, ",", "") ?></h3>
            <?php
            if (isset($_SESSION['id'])) { ?>
                <button class="fcc-btn buy-button" onclick='addToCart(<?= json_encode($dish); ?>)'>Add to cart</button>
            <?php } ?>
    </article>
<?php } ?>

<?php function drawFavoriteDish($dish, $isfav)
{?>
    <script src="../javascript/favorites.js"></script>
    <a href = <?="http://localhost:9000/pages/profile.php?res=".$dish['idRestaurant']?>>
    <article>
        <img src=<?php echo ($dish['photo'] != null) ? "../images/dish/small/" . $dish['photo'] . ".jpg" : 'https://picsum.photos/200/200?business?id=' . $dish['idDish'] ?>>
        <h2 class="dish"><?= ucfirst($dish['name']) ?>
            <?php if ($isfav == 'false') { ?>
                <a id=<?= "toggle" . $dish['idDish'] ?> onclick="toggleFavoriteDish('<?= $dish['idDish'] ?>', '<?= $isfav ?>')">
                    <i id="star-icon<?=$dish['idDish']?>" style='float:right' class="fa fa-star-o" aria-hidden="true"></i>
                </a>
            <?php } else { ?>
                <a id=<?= "toggle" . $dish['idDish'] ?> onclick="toggleFavoriteDish('<?= $dish['idDish'] ?>', '<?= $isfav ?>')">
                    <i id="star-icon<?=$dish['idDish']?>" style='float:right' class="fa fa-star" aria-hidden="true"></i>
                </a>
            <?php } ?>
        </h2>
        <h4 class="dish_category"><?= ucfirst($dish['category']) ?></h5>
            <h3 class="dish_price"><?= "$ " . number_format(floatval($dish['price']), 2, ",", "") ?></h3>
    </article>
<?php } ?>


<?php function isOwner($idRestaurant): bool
{
    if (!isset($_SESSION['id'])) {
        return false;
    }
    require_once(__DIR__ . '/../database/connection.db.php');

    $db = getDatabaseConnection();

    $stmt = $db->prepare('Select * from Restaurant_owner where idRestaurant = ?');
    $stmt->execute(array($idRestaurant));
    $owners = $stmt->fetchAll();
    $isowner = false;
    foreach ($owners as $owner) {
        if ($_SESSION['id'] == $owner['idUser']) {
            $isowner = true;
        }
    }

    return $isowner;
} ?>