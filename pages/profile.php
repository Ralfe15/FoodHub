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
else
    $minprice = 0;
?>
<?php 
    require_once(__DIR__ . '/../templates/common.tpl.php');
    require_once(__DIR__ . '/../templates/restaurant.tpl.php');

    drawHeader("style-profile");
?>
<div class="container">
        <div class="profile">
            <h1 id="title"><a href="../pages/profile.php?res=<?php echo($res)?>"><?php echo($result[0]["name"])?></a></h1>
            <a href="../pages/restaurant.html" id="logo"><img src="https://picsum.photos/200/200?business"></a>
            <h4 id="category">Food</h4>
            <h4 id="price"><?="From $$minprice,00"?></h4>
            <h4 id="rating">5</h4>
            <form action="../actions/save.php" method="get" id="search">
                <input type="text" name="search" placeholder="Search dishes">
                <button formaction="restaurant.html" formmethod="post" type="submit">&#x276F</button>
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
            $dish['category']
            );
        } ?>
    </section>
</div>
<?=drawFooter();?>
