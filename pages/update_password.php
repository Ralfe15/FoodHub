<?php

declare(strict_types=1);
session_start();
require_once(__DIR__ . '/../templates/common.tpl.php');

drawHeader();
if (!isset($_SESSION['id'])) header('Location: http://localhost:9000/pages/login.php');
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../styles/login.css">

<script src="/../javascript/update_profile_script.js"></script>

<div class="title">
    <h1>Edit password:</h1>
</div>
<div class="form-login">
    <form action="../actions/action_update_password.php" method="post" id="form_login">
        <p>
            <input type="password" required name="prevPass" placeholder="Previous password" />
        </p>
        <p>
            <input type="password" required name="newPass" placeholder="New password" />
        </p>
        <p>
            <input type="password" required name="newPassConfirm" placeholder="New password" />
        </p>
        <button type="submit">Update password</button>
    </form>
</div>
<?php 
    if(isset($_GET['successmatch'])){
        if($_GET['successmatch'] == 'false')
        ?>
    <p class="error-msg">Passwords dont match</p>
    <?php
    }
    ?>
    <?php 
    if(isset($_GET['successprev'])){
        if($_GET['successprev'] == 'false')
        ?>
    <p class="error-msg">Wrong previous password</p>
    <?php
    }
    ?>
    </body>
    
    <?= drawFooter(); ?>