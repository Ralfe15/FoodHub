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
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="jquery.form.js"></script>
<script>
$(document).ready(function() { 
 $('form').ajaxForm(function() { 
 }); 
});
</script>

<h1 style="text-align: center;">Edit profile </h1>
<div class="labeled-form">
    <form action="../actions/action_update_profile.php" method="post" enctype="multipart/form-data">
        <?php
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
                <input type=<?= $type ?> <?php echo ($field=='avatar')?'':'required';?> name="<?= $field ?>" value="<?= $value ?>" />
            </p>
        <?php   
        if(isset($_POST['avatar']))
        {
         $avatar=$_FILES["avatar"]["tmp_name"];
         $folder="images/";
         move_uploaded_file($_FILES["upload_file"]["tmp_name"], "$folder".$_FILES["upload_file"]["name"]);
         exit();
        }
        }
        ?>
        <p>
            <button type="submit">Save Changes</button>
        </p>
    </form>

</div>
<div class="login-extra-buttons">
    <a class="fcc-btn" href='../pages/update_password.php'>Change password</a>
</div>
<div class="login-extra-buttons">
    <a class="fcc-btn" href='../pages/manage_restaurants.php'>Manage Restaurants</a>
</div>

<?php drawFooter()?>
