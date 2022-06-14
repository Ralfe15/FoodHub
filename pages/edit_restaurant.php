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
$db = getDatabaseConnection();
$stmt = $db->prepare('Select * from Restaurant where idRestaurant = ?');
$stmt->execute(array($res));
$result = $stmt->fetchAll();



drawHeader();
?>
<head>
    <link rel="stylesheet" href="../styles/common.css">
    <link rel="stylesheet" href="../styles/edit.css">
</head>
<script src="/../javascript/update_profile_script.js"></script>
<h1 style="text-align: center;">Edit Restaurant</h1>
<div class="labeled-form">
    <div id='preview'>
        <img  id="avatar-preview" src=<?php echo ($result[0]['logo']!=null) ? "../images/restaurant/medium/". $result[0]['logo'] .".jpg" : 'https://picsum.photos/200/200?business?id='. $res?>>
    </div>
    <form action="../actions/action_edit_restaurant.php" method="post" id="form_edit_restaurant" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?=$res?>">
        <p>
            <label>Name:</label>
            <input type="text" name="name" placeholder="<?=$result[0]["name"]?>" />
        </p>
        <p>
            <label>Category:</label>
            <input type="text" name="category" placeholder="<?=$result[0]["category"]?>" />
        </p>
        <p>
            <label>Address:</label>
            <input type="text" name="address" placeholder="<?=$result[0]["address"]?>" />
        </p>
        <p>
            <label>Logo:</label>
            <input type="file" onchange="readURL(this);"  name="image" title="Logo:">
        </p>
        <p>
            <button type="submit">Save</button>
        </p>
    </form>
    <form action="../actions/action_delete_restaurant.php" method="post" id="form_edit_restaurant" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?=$res?>">
        <p>
            <button type="submit">Delete Restaurant</button>
        </p>
    </form>
</div>
<?=drawFooter();?>