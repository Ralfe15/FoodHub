<?php 
declare(strict_types = 1);
require_once('templates/common.tpl.php');
require_once('database/connection.db.php');

$db = getDatabaseConnection();

$res = "%{$_POST['search']}%";
$stmt = $db->prepare('Select * from Restaurant natural join Review where name LIKE ?');
$stmt->execute(array($res));
$results = $stmt->fetchAll();
?>

<?=drawHeader("style-search");?>
<html lang="en-US">
    <div class="search-bar-home">
        <form action="profile.php" method="get">
            <input type="text" placeholder="Showing results for: 
 <?= $_POST['search'];?>">
            <button type="submit" class="search-button"></button>
        </form>
    </div>
    
    <main>
    <section id="results-grid">
        <?php
        foreach($results as $restaurant)
        {
        ?>
        <article>
            <img src="https://www.citypng.com/public/uploads/preview/-11600735522qbwj7xtpxu.png" width="50" height="50">
            <h2><?=$restaurant['name'];?></h2>
            <h3><?=$restaurant['category'];?></h3>
            <img src="https://thumbs.dreamstime.com/z/imagem-do-%C3%ADcone-de-estrelas-83946136.jpg" width="50" height="50">
        </article>
        <?php }
        ?>
    </section>
    </main>
</body>
<?=drawFooter();?>

</html>