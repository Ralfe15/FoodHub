<?php 
session_start();
require_once(__DIR__ . '/../templates/common.tpl.php');

drawHeader();
?>
<html>
    <head>
        <link rel="stylesheet" href="../styles/login.css">
    </head>
    <body>
        <h1 style="text-align: center;">Sign up</h1>
        <div class="form">
            <form action="../actions/action_signup.php" method="post" id="form_login">
                <p> 
                    <input type="text" required name="name" placeholder="name" />
                </p>
                <p> 
                    <input type="email" required name="email" placeholder="email" />
                </p>
                <p>
                    <input type="password" required name="password" placeholder="password" />
                </p>
                <p>
                    <input type="password" required name="password-confirmation" placeholder="repeat password" />
                </p>
                <p>
                    <input type="tel" required name="phone" placeholder="phone" />
                </p>
                <p>
                    <input type="text" required name="address" placeholder="address" />
                </p>
                <p>
                    <button type="submit">Sign up</button>
                </p>
            </form>

        </div>
        <?php 
    if(isset($_GET['success'])){
        if($_GET['success'] == 'false')
        ?>  
    <p class="error-msg">Email address already in use!</p>
    <?php
    }
    ?>
    <?php 
    if(isset($_GET['match'])){
        if($_GET['match'] == 'false')
        ?>  
    <p class="error-msg">Passwords dont match</p>
    <?php
    }
    ?>
    </body>
</html>
<?=drawFooter();?>
