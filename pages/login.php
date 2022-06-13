<?php
session_start();
require_once(__DIR__ . '/../templates/common.tpl.php');

drawHeader();
?>
<html>
    <head>
        <link rel="stylesheet" href="../styles/common.css">
        <link rel="stylesheet" href="../styles/login.css">
    </head>
    <body>
<h1 style="text-align: center;">Login </h1>
<div class="form">
    <form action="../actions/action_login.php" method="post">
        <p>
            <input type="text" required name="email" placeholder="email" />
        </p>
        <p>
            <input type="password" required name="password" placeholder="password" />
        </p>
        <p>
            <button type="submit">Login</button>
        </p>
    </form>
</div>
<?php 
    if(isset($_GET['success'])){
        if($_GET['success'] == 'false')
        ?>
    <p class="error-msg">Wrong email/password</p>
    <?php
    }
    ?>
        </body>
</html>
<?=drawFooter();?>