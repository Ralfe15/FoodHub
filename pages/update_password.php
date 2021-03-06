<?php

declare(strict_types=1);
session_start();
require_once(__DIR__ . '/../templates/common.tpl.php');

drawHeader();
if (!isset($_SESSION['id'])) header('Location: http://localhost:9000/pages/login.php');
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../styles/login.css">
<link rel="stylesheet" href="../styles/common.css">

<script src="/../javascript/update_profile_script.js"></script>

<div class="title">
    <h1>Edit password:</h1>
</div>
<div class="form">
    <form action="../actions/action_update_password.php" method="post">
        <p>
            <input id="password" type="password" required name="prevPass" placeholder="Previous password" />
            <button type="button" id='toggle' onclick="togglePassword('password')"><i class="fa fa-eye"></i></button>
        </p>
        <p>
            <input id="newPass" type="password" required name="newPass" placeholder="New password" />
            <button type="button" id='toggle' onclick="togglePassword('newPass')"><i class="fa fa-eye"></i></button>
        </p>
        <p>
            <input id="newPassConfirm"type="password" required name="newPassConfirm" placeholder="New password" />
            <button type="button" id='toggle' onclick="togglePassword('newPassConfirm')"><i class="fa fa-eye"></i></button>
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