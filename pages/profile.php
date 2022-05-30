<?php 
declare(strict_types = 1);

session_start();

require_once(__DIR__. '/../database/connection.db.php');

$db = getDatabaseConnection();

$res = $_GET['res'];
$stmt = $db->prepare('Select * from Restaurant where idRestaurant = ?');
$stmt->execute(array($res));
$result = $stmt->fetchAll();

$stmt = $db->prepare('Select * from Dish where idRestaurant = ?');
$stmt->execute(array($res));
$dishes = $stmt->fetchAll();
foreach($dishes as $dish){
    $prices[] = intval($dish['price']);
}
if(isset($prices)){
    sort($prices);
    $minprice = $prices[0];
}
else{$minprice = 0;}


if(isset($_GET['dish'])){
    $searched_dish = "%{$_GET['dish']}%";
    $stmt = $db->prepare('Select * from Dish where idRestaurant = ? AND name LIKE ?');
    $stmt->execute(array($res, $searched_dish));
    $dishes = $stmt->fetchAll();
}
$stmt = $db->prepare('Select * from Restaurant_owner where idRestaurant = ?');
$stmt->execute(array($res));
$owners = $stmt->fetchAll();
if(isset($_SESSION['id'])){
    $isowner = false;
    foreach($owners as $owner){
        if($_SESSION['id'] == $owner['idUser']){
            $isowner = true;
        }
    }
}

?>
<?php 
    require_once(__DIR__ . '/../templates/common.tpl.php');
    require_once(__DIR__ . '/../templates/restaurant.tpl.php');

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
                    <h1 id="title"><a href="../pages/profile.php?res=<?php echo($res)?>"><?php echo($result[0]["name"])?></a></h1>
                    <a href="../pages/profile.php?res=<?php echo($res)?>" id="logo"><img src="https://picsum.photos/200/200?business"></a>
                    <h4 id="category"><?php echo($result[0]["category"])?></h4>
                    <h4 id="price"><?="From $$minprice,00"?></h4>
                    <h4 id="rating">5</h4>
                    <form action="../pages/profile.php" method="get" id="search">
                        <input type="hidden" name="res" value="<?php echo($res)?>">
                        <input type="text" name="dish" placeholder="Search dishes">
                        <button type="submit" class="search-button"><i></i>&#x276F</button>
                    </form>
                </div>
            </header>
            <section id="highlights">
                <?php 
                foreach($dishes as $dish) { 
                    drawDish(
                    "https://picsum.photos/400/200?business/1", //$dish['photo'],
                    $dish['name'], 
                    $dish['price'],
                    $dish['category'],
                    $dish
                    );
                } ?>
                
            </section>
            <?php 
                if(isset($_SESSION['id'])){
                if($isowner) { ?>
                <div class="form">
                    <a class="central-button" href='../pages/edit_restaurant.php'>Edit Restaurant</a>
                </div>
            <?php } 
        }?>
        </div>
    </body>
</html>
<?=drawFooter();?>
