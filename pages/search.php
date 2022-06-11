<?php

declare(strict_types=1);
session_start();

require_once(__DIR__ . '/../templates/common.tpl.php');
require_once(__DIR__ . '/../database/connection.db.php');

$db = getDatabaseConnection();

$res = "%{$_POST['search']}%";
$stmt = $db->prepare('Select * from Restaurant where name LIKE ?');
$stmt->execute(array($res));
$results = $stmt->fetchAll();
?>

<?= drawHeader(); ?>
<html lang="en-US">

<head>
    <script src="/../javascript/favorites.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../styles/style-search.css">
</head>

<body>
    <div id="search-div">
        <form action="/../pages/search.php" id="search" method="POST">
            <input type="text" placeholder="Showing results for: <?= $_POST['search']; ?>" name="search">
            <button type="submit" class="search-button"><i></i>&#x276F</button>
        </form>
    </div>
    <main>
        <section class="results-grid">
            <?php
            foreach ($results as $restaurant) {
                $stmt = $db->prepare('Select avg(rating) as rating from Review where idRestaurant = ?');
                $stmt->execute(array($restaurant['idRestaurant']));
                $rating = $stmt->fetch();
                $rating = (isset($rating['rating'])) ? number_format((float)$rating['rating'], 1, '.', '') . '  <i class="fa fa-star" aria-hidden="true"></i>' : "No ratings";
                if(isset($_SESSION['id'])){
                $stmt = $db->prepare('Select * from Favorite_restaurants where idRestaurant = ? and idUser = ?');
                $stmt->execute(array($restaurant['idRestaurant'], $_SESSION['id']));
                $isfav = $stmt->fetchAll();
                $isfav = ($isfav == null) ? "false" : "true";     
                }           
            ?>

                <div class="card">
                    <a href="../pages/profile.php?res=<?php echo ($restaurant['idRestaurant']) ?>">
                        <img src="https://www.citypng.com/public/uploads/preview/-11600735522qbwj7xtpxu.png" alt="Avatar" style="width:100%">
                        <div class="container">
                            <h4><b><?= $restaurant['name']; ?></b></h4>
                            <p><?= $restaurant['category']; ?></p>
                            <p><?= $rating ?> </p>
                            </a>
                            <?php  if(isset($_SESSION['id'])){
                            if($isfav == 'false'){ ?>
                            <a onclick="toggleFavorite('<?= $restaurant['idRestaurant'] ?>', '<?= $isfav ?>')">Add to favorites : <i id="heart-icon<?=$restaurant['idRestaurant']?>"class="fa fa-heart-o" aria-hidden="true"></i></a>
                            <?php }?>
                            <?php if($isfav == 'true'){ ?>
                            <a onclick="toggleFavorite('<?= $restaurant['idRestaurant'] ?>', '<?= $isfav ?>')">Remove from favorites : <i id="heart-icon<?=$restaurant['idRestaurant']?>"class="fa fa-heart" aria-hidden="true"></i></a>
                            <?php }}?>
                        </div>

                </div>
            <?php }
            ?>
        </section>
    </main>
</body>

</html>
<?= drawFooter(); ?>