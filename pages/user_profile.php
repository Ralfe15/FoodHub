<?php

declare(strict_types=1);
session_start();
require_once(__DIR__ . '/../templates/common.tpl.php');
require_once(__DIR__ . '/../database/connection.db.php');


if (!isset($_SESSION['id'])) header('Location: http://localhost:9000/pages/login.php');
drawHeader();

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
<link rel="stylesheet" href="../styles/login.css">

<script src="/../javascript/update_profile_script.js"></script>

<h1 style="text-align: center;">Edit profile </h1>
<div class="form-login">
    <form action="../actions/action_update_profile.php" method="post">
        <?php
        unset($result[0]['idUser']); //we dont want do display this
        unset($result[0]['password']);
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
                <input type=<?= $type ?> required name="<?= $field ?>" value="<?= $value ?>" />
            </p>
        <?php
        }
        ?>
        <p>
            <button type="submit">Edit profile</button>
        </p>
    </form>

</div>
<div class="form-login">
    <a class="fcc-btn" href='../pages/update_password.php'>Change password</a>
</div>
<?php
if ($result2) {
?>
    <div class="form-login">
        <a class="fcc-btn" href='../pages/update_restaurant.php'>Edit restaurant</a>
    </div>
<?php
}
?>