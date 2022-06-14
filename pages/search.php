<?php

declare(strict_types=1);
session_start();

require_once(__DIR__ . '/../templates/common.tpl.php');
require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../templates/search.tpl.php');
require_once(__DIR__ . '/../utils/sorting_utils.php');


$db = getDatabaseConnection();

$res = "%{$_POST['search']}%";
if ($_POST['search-type'] == "restaurant") {
    $stmt = $db->prepare('Select * from Restaurant where name LIKE ?');
    $stmt->execute(array($res));
    $results = $stmt->fetchAll();
    foreach ($results as &$restaurant) {
        $stmt = $db->prepare('Select avg(rating) as rating from review where idRestaurant = ?');
        $stmt->execute(array($res));
        $rating = $stmt->fetch();
        $rating = (isset($rating['rating'])) ? floatval($rating['rating']) : 0;
        $restaurant['rating'] = $rating;
    }
    usort($results, 'rating_compare');
}
if ($_POST['search-type'] == "dish") {
    $stmt = $db->prepare('select restaurant.idrestaurant, restaurant.name, restaurant.category, restaurant.address, restaurant.logo from dish inner join restaurant on dish.idRestaurant = restaurant.idRestaurant where dish.name like ?');
    $stmt->execute(array($res));
    $results = $stmt->fetchAll();
}
?>

<?= drawHeader(); ?>
<html lang="en-US">

<head>
    <script src="/../javascript/favorites.js"></script>
    <script src="/../javascript/toggle_search.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../styles/style-search.css">
</head>

<body>
    <div id="search-div">
        <form action="/../pages/search.php" id="search" method="POST">
            <input type="text" placeholder="Showing results for: <?= $_POST['search']; ?>" name="search">
            <input type="text" id="search-type" name="search-type" style="display:none" value="restaurant">
            <button type="submit" class="search-button"><i></i>&#x276F</button>
        </form>
    </div>
    <div class="search-by">
        <span>By:</span>
        <input type="radio" name="select" id="option-1" value="restaurant" <?php if ($_POST['search-type'] == "restaurant") echo 'checked' ?> onclick="toggleSearch()">
        <input type="radio" name="select" id="option-2" value="dish" <?php if ($_POST['search-type'] == "dish") echo 'checked' ?> onclick="toggleSearch()">
        <label for="option-1" class="option option-1" name="restaurant">
            <div class="dot"></div>
            <span>Restaurant</span>
        </label>
        <label for="option-2" class="option option-2" name="dish">
            <div class="dot"></div>
            <span>Dish</span>
        </label>
    </div>
    <main>
        <section class="results-grid">
            <?php
            foreach ($results as $restaurant) {
                drawRestaurant($restaurant);
            }
            ?>
        </section>
    </main>
</body>

</html>
<?= drawFooter(); ?>