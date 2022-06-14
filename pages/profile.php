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
$stmt = $db->prepare('Select avg(rating) as rating from Review where idRestaurant = ?');
$stmt->execute(array($res));
$rating = $stmt->fetch();
$stmt = $db->prepare('Select * from Dish where idRestaurant = ?');
$stmt->execute(array($res));
$dishes = $stmt->fetchAll();
foreach ($dishes as $dish) {
    $prices[] = floatval($dish['price']);
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
    <link rel="stylesheet" href="../styles/style-review.css">

    <link rel="stylesheet" href="../styles/common.css">
</head>

<body>
    <div class="container">
        <div class="profile">
            <h1 id="title"><a href="../pages/profile.php?res=<?php echo ($res) ?>"><?php echo ($result[0]["name"]) ?></a></h1>
            <a href="../pages/profile.php?res=<?php echo ($res) ?>" id="logo"><img src=<?php echo ($result[0]['logo'] != null) ? "../images/restaurant/medium/" . $result[0]['logo'] . ".jpg" : 'https://www.citypng.com/public/uploads/preview/-11600735522qbwj7xtpxu.png' ?>></a>
            <div id="category">
            <h4><?php echo ($result[0]["category"]) ?></h4>
            <p><?= ($rating['rating']==null) ? 'Not rated' : $rating['rating'] . ' <i class="fa fa-star" aria-hidden="true"></i>' ?></p>
            </div>
            <h4 id="price"><?= "From $".number_format(floatval($minprice), 2, ",", "") ?></h4>
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
    <div class="wrapper">

        <h3>Reviews: </h3>
        <?php
        $stmt = $db->prepare('select user.name, restaurant.name as restaurant, review.rating, review.review, review_answer.answer from Review left join review_answer on Review.idOrder = review_answer.idOrder join user on review.idUser = user.idUser join restaurant on review.idRestaurant = restaurant.idRestaurant where review.idRestaurant = ?');
        $stmt->execute(array($res));
        $reviews = $stmt->fetchAll();
        if (isset($reviews) && (count($reviews) != 0)) {
        ?>
            <table class="orders-table">
                <tbody>
                    <?php foreach ($reviews as $review) { ?>
                        <tr>

                            <td>
                                <span>
                                    User: <?=$review['name'] ?>
                                </span>
                                <p>Review: <?= $review['review'] ?></p>
                                <p>Rating: <?= $review['rating'] ?> <i class="fa fa-star" aria-hidden="true"></i></p>
                            </td>
                        </tr>
                        <?php if ($review['answer'] != null) { ?>
                            <tr>
                                <td>
                                    <span>
                                        <?= $review['restaurant'] ?> answered <?= $review['name'] ?>:
                                    </span>
                                    <p><?= $review['answer'] ?></p>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        <?php }
        else { ?>
            <p>No reviews to show :(</p>
        <?php } ?>
    </div>
</body>

</html>
<?= drawFooter(); ?>