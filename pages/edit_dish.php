<?php
declare(strict_types = 1);

session_start();

require_once(__DIR__. '/../database/connection.db.php');
require_once(__DIR__ . '/../templates/common.tpl.php');
require_once(__DIR__ . '/../templates/restaurant.tpl.php');

$idDish = $_GET['dish'];
$db = getDatabaseConnection();
$stmt = $db->prepare('Select * from Dish where idDish = ?');
$stmt->execute(array($idDish));
$result = $stmt->fetchAll();

$isowner = isOwner($result[0]['idRestaurant']);
if(!$isowner){
    header('Location: http://localhost:9000/pages/index.php?');
}

drawHeader();
?>
<head>
    <link rel="stylesheet" href="../styles/common.css">
    <link rel="stylesheet" href="../styles/edit.css">
</head>
<script src="/../javascript/update_profile_script.js"></script>
<h1 style="text-align: center;">Edit Dish</h1>
<div class="labeled-form">
    <div id='preview'>
        <img  id="avatar-preview" src=<?php echo ($result[0]['photo']!=null) ? "../images/dish/medium/". $result[0]['photo'] .".jpg" : 'https://picsum.photos/200/200?business?id='. $result[0]['idDish']?>>
    </div>
    <form action="../actions/action_edit_dish.php" method="post" id="form_edit_restaurant" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?=$idDish?>">
        <input type="hidden" name="idRestaurant" value="<?=$result[0]['idRestaurant']?>">
        <p>
            <label>Name:</label>
            <input type="text" name="name" placeholder="<?=$result[0]["name"]?>" />
        </p>
        <p>
            <label>Category:</label>
            <input type="text" name="category" placeholder="<?=$result[0]["category"]?>" />
        </p>
        <p>
            <label>Price:</label>
            <input type="number" min="0.01" step="0.01" name="price" placeholder="<?=$result[0]["price"]?>" />
        </p>
        <p>
            <label>Photo:</label>
            <input type="file" onchange="readURL(this);" name="image">
        </p>
        <p>
            <button type="submit">Save</button>
        </p>
    </form>
    <form action="../actions/action_delete_dish.php" method="post" id="form_edit_restaurant" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?=$idDish?>">
        <input type="hidden" name="idRestaurant" value="<?=$result[0]['idRestaurant']?>">
        <p>
            <button type="submit">Delete Dish</button>
        </p>
    </form>
</div>
<?=drawFooter();?>