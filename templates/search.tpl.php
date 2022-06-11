<?php declare(strict_types = 1); ?>

<?php function drawRestaurant($restaurant) { 
    require_once(__DIR__ . '/../database/connection.db.php');

    $db = getDatabaseConnection();

    $stmt = $db->prepare('Select avg(rating) as rating from Review where idRestaurant = ?');
    $stmt->execute(array($restaurant['idRestaurant']));
    $rating = $stmt->fetch();
    $rating = (isset($rating['rating'])) ? number_format((float)$rating['rating'], 1, '.', '') . '  <i class="fa fa-star" aria-hidden="true"></i>' : "No ratings";
    
    if(isset($_SESSION['id'])){
        $stmt = $db->prepare('Select * from Favorite_restaurants where idRestaurant = ? and idUser = ?');
        $stmt->execute(array($restaurant['idRestaurant'], $_SESSION['id']));
        $isfav = $stmt->fetchAll();
        $isfav = ($isfav == null) ? "false" : "true";     
    } ?>
    
    <div class="card">
        <a href="../pages/profile.php?res=<?php echo ($restaurant['idRestaurant']) ?>">
            <img src=<?php echo("../images/restaurant/small/" . $restaurant['logo'] . ".jpg")?>>
            <div class="container">
                <h4><b><?= $restaurant['name']; ?></b></h4>
                <p><?= $restaurant['category']; ?></p>
                <p><?= $rating ?> </p>
            </div>
            <?php  if(isset($_SESSION['id'])){
            if($isfav == 'false'){ ?>
            <a onclick="toggleFavorite('<?= $restaurant['idRestaurant'] ?>', '<?= $isfav ?>')">Add to favorites : <i id="heart-icon<?=$restaurant['idRestaurant']?>"class="fa fa-heart-o" aria-hidden="true"></i></a>
            <?php }?>
            <?php if($isfav == 'true'){ ?>
            <a onclick="toggleFavorite('<?= $restaurant['idRestaurant'] ?>', '<?= $isfav ?>')">Remove from favorites : <i id="heart-icon<?=$restaurant['idRestaurant']?>"class="fa fa-heart" aria-hidden="true"></i></a>
            <?php }}?>
        </a>       
    </div>
<?php }?>
