<?php
declare(strict_types = 1);

session_start();

require_once(__DIR__. '/../database/connection.db.php');
require_once(__DIR__ . '/../templates/common.tpl.php');
require_once(__DIR__ . '/../templates/restaurant.tpl.php');

$res = $_GET['res'];
$isowner = isOwner($res);
if(!$isowner){
    header('Location: http://localhost:9000/pages/index.php?');
}

drawHeader();
?>
<head>
    <link rel="stylesheet" href="../styles/common.css">
</head>
<h1 style="text-align: center;">Add Dish</h1>
<div class="form">
    <form action="../actions/action_add_dish.php" method="post" id="form_edit_restaurant" enctype="multipart/form-data">
            <input type="hidden" name="idRestaurant" value="<?=$res?>">
            <p>
                <input type="text" required name="name" placeholder="name" />
            </p>
            <p>
                <input type="text" required name="category" placeholder="category" />
            </p>
            <p>
                <input type="number" required name="price" placeholder="price" />
            </p>
            <p>
                
            </p>
            <p>
                <label>Photo:</label>
                <input type="file" name="image">
            </p>
            <p>
                <button type="submit">Save</button>
            </p>
        </form>
</div>
<?=drawFooter();?>