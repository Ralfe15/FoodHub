<?php

declare(strict_types=1);
session_start();
require_once('templates/common.tpl.php');
require_once('database/connection.db.php');


if (!isset($_SESSION['id'])) header('Location: http://localhost:9000/login.php');;
drawHeader('login');

$db = getDatabaseConnection();

$id = $_SESSION['id'];

$stmt = $db->prepare('Select * from user where idUser = ?');
$stmt->execute(array($id));
$result = $stmt->fetchAll();
$stmt = $db->prepare('Select * from restaurant_owner where idUser = ?');
$stmt->execute(array($id));
$result2 = $stmt->fetchAll();


?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="javascript/script.js"></script>

<h1 style="text-align: center;">Edit profile </h1>
<div class="form-login">
    <form action="action_update_profile.php" method="post">
        <?php
        unset($result[0]['idUser']); //we dont want do display this
        foreach ($result[0] as $field => $value) {
            switch ($field) {
                case 'name':
                    $type = 'text';
                    break;
                case 'email':
                    $type = 'email';
                    break;
                case 'phone':
                    $type = 'tel';
                    break;
                case 'address':
                    $type = 'text';
                    break;
                case 'password':
                    $type = 'password';
                    break;
                default:
                    $type = 'text';
                    break;
            }
        ?>
            <p>
                <label><?= ucfirst($field) ?>:</label>
                <?php
                if ($field == 'password') { ?>
                    <input id='password' type=<?= $type ?> required name="<?= $field ?>" value="<?= $value ?>" />
                    <button type="button" id='toggle' onclick="togglePassword()"><i class="fa fa-eye"></i></button>
                <?php } else { ?>
                    <input type=<?= $type ?> required name="<?= $field ?>" value="<?= $value ?>" />
                <?php
                }
                ?>
            </p>
        <?php
        }
        ?>
        <p>
            <button type="submit">Edit profile</button>
        </p>
    </form>
</div>
<?php 
if($result2){
?>
<div class="form-login">
    <button href='update_restaurant.php'>Edit restaurant</button>
</div>
<?php 
}
?>