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


?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../styles/common.css">
<link rel="stylesheet" href="../styles/login.css">

<script src="/../javascript/update_profile_script.js"></script>

<h1 style="text-align: center;">Edit profile </h1>
<div class="labeled-form">
    <form id="imageform" action="../actions/action_update_profile.php" method="post" enctype="multipart/form-data">
        <?php
        $id = $result[0]['idUser'];
        unset($result[0]['idUser']);
        unset($result[0]['password']);
        foreach ($result[0] as $field => $value) {
            switch ($field) {
                case 'email':
                    $type = 'email';
                    break;
                case 'phone':
                    $type = 'tel';
                    break;
                case 'password':
                    $type = 'password';
                    break;
                case 'avatar':
                    $type = 'file';
                    break;
                default:
                    $type = 'text';
                    break;
            }
        ?>
            <p>
                <label><?= ucfirst($field) ?>:</label>
                <input type=<?= $type ?> <?php echo ($field == 'avatar') ? 'id=photoimg onchange="readURL(this);"' : 'required'; ?> name="<?= $field ?>" value="<?= $value ?>" />
            </p>
        <?php } ?>
        <p>
            <button type="submit">Save Changes</button>
        </p>
    </form>
    <div id='preview'>
        <img id="avatar-preview" src=<?php echo ($result[0]['avatar'] != null) ? "../images/user/small/" . $result[0]['avatar'] . ".jpg" : 'https://picsum.photos/200/200?business?id=' . $id ?>>
    </div>
</div>
<div class="login-extra-buttons">
    <a class="fcc-btn" href='../pages/update_password.php'>Change password</a>
</div>
<div class="login-extra-buttons">
    <a class="fcc-btn" href='../pages/manage_restaurants.php'>Manage Restaurants</a>
</div>

<?php drawFooter() ?>