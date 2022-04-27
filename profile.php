<?php 
declare(strict_types = 1);
require_once('database/connection.db.php');

$db = getDatabaseConnection();

$res = $_GET['res'];
$stmt = $db->prepare('Select * from Restaurant where idRestaurant = ?');
$stmt->execute(array($res));
$result = $stmt->fetchAll();
?>
<?php 
    require_once('templates/common.tpl.php');

    drawHeader("style-profile");
?>
<div class="container">
        <div class="profile">
            <h1 id="title"><a href="restaurant.php?res=<?php echo($res)?>"><?php echo($result[0]["name"])?></a></h1>
            <a href="restaurant.html" id="logo"><img src="https://picsum.photos/200/200?business"></a>
            <h4 id="category">Food</h4>
            <h4 id="price">From $0,00</h4>
            <h4 id="rating">5</h4>
            <form action="save.php" method="get" id="search">
                <input type="text" name="search" placeholder="Search dishes">
                <button formaction="restaurant.html" formmethod="post" type="submit">&#x276F</button>
            </form>
        </div>
    </header>
    <section id="highlights">
        <article>
            <img src="https://picsum.photos/400/200?business/1">
            <h2 class="dish">Dish</h2>
            <h3 class="dish_price">$0.00</h3>
        </article>
        <article>
            <img src="https://picsum.photos/400/200?business/2">
            <h2 class="dish">Dish</h2>
            <h3 class="dish_price">$0.00</h3>
        </article>
        <article>
            <img src="https://picsum.photos/400/200?business/3">
            <h2 class="dish">Dish</h2>
            <h3 class="dish_price">$0.00</h3>
        </article>
    </section>
</div>
<?=drawFooter();?>
