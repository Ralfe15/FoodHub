<?php

declare(strict_types=1);

session_start();

require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../templates/restaurant.tpl.php');

$db = getDatabaseConnection();

$res = $_GET['res'];
$stmt = $db->prepare('Select * from Restaurant where idRestaurant = ?');
$stmt->execute(array($res));
$result = $stmt->fetchAll();

$stmt = $db->prepare('Select * from Dish where idRestaurant = ?');
$stmt->execute(array($res));
$dishes = $stmt->fetchAll();
foreach ($dishes as $dish) {
    $prices[] = intval($dish['price']);
}
if (isset($prices)) {
    sort($prices);
    $minprice = $prices[0];
} else {
    $minprice = 0;
}


if (isset($_GET['dish'])) {
    $searched_dish = "%{$_GET['dish']}%";
    $stmt = $db->prepare('Select * from Dish where idRestaurant = ? AND name LIKE ?');
    $stmt->execute(array($res, $searched_dish));
    $dishes = $stmt->fetchAll();
}
$isowner = isOwner($res);

?>
<?php
require_once(__DIR__ . '/../templates/common.tpl.php');

drawHeader();
?>
<html>

<head>
    <link rel="stylesheet" href="../styles/style-profile.css">
    
    <link rel="stylesheet" href="../styles/common.css">
</head>

<body>
    <div class="container">
        <div class="profile">
            <h1 id="title"><a href="../pages/profile.php?res=<?php echo ($res) ?>"><?php echo ($result[0]["name"]) ?></a></h1>
            <a href="../pages/profile.php?res=<?php echo ($res) ?>" id="logo"><img src=<?php echo ($result[0]['logo'] != null) ? "../images/restaurant/medium/" . $result[0]['logo'] . ".jpg" : 'https://www.citypng.com/public/uploads/preview/-11600735522qbwj7xtpxu.png' ?>></a>
            <h4 id="category"><?php echo ($result[0]["category"]) ?></h4>
            <h4 id="price"><?= "From $$minprice" ?></h4>
            <h4 id="rating">5</h4>
            <form action="../pages/profile.php" method="get" id="search">
                <input type="hidden" name="res" value="<?php echo ($res) ?>">
                <input type="text" name="dish" placeholder="Search dishes">
                <button type="submit" class="search-button"><i></i>&#x276F</button>
            </form>
        </div>
        </header>
        <section id="highlights">
            <?php
            foreach ($dishes as $dish) {
                drawDish($dish);
            } ?>
        </section>
        <?php if ($isowner) { ?>
            <div class="management">
                <a class="central-button" href='../pages/edit_restaurant.php?res=<?= $res ?>'>Edit Restaurant</a>
                <a class="central-button" style='margin-left: 10px;' href='../pages/add_dish.php?res=<?= $res ?>'>Add Dishes</a>
                <a class="central-button" style='margin-left: 10px;' href='../pages/owner_orders.php?res=<?= $res ?>'>Manage orders</a>
            </div>
        <?php } ?>
    </div>
    <h3>Reviews: </h3>
    <?php 
    $stmt = $db->prepare('SELECT review, rating, user.name from Review JOIN user on review.idUser = user.idUser WHERE idRestaurant = ?');
    $stmt->execute(array($res));
    $reviews = $stmt->fetchAll();
    if(isset($reviews)){
    ?>
    <tbody>
        <?php foreach($reviews as $review){?>
        <tr>
            <td>
                <span>
                    <?=$review['name']?>
                </span>
                <p><?=$review['review']?></p>
                <p><?=$review['rating']?>/5</p>
            </td>
        </tr>
        <?php
         } 
        ?>
    </tbody>
    <?php }?>
    </div>
</body>

</html>
<?= drawFooter(); ?>