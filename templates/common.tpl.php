<?php

declare(strict_types=1); ?>
<?php function drawHeader()
{ ?>
    <!DOCTYPE html>
    <html lang="en-US">

    <head>
        <title>Ifoodclone</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../styles/common.css">
    </head>

    <body>
        <header>
            <div id="menu">
                <a href="../pages/index.php" id="return">Ifoodclone</a>
                <?php if (isset($_SESSION['id'])) drawLogoutOptions($_SESSION["name"]);
                else drawLoginOptions();
                ?>
            </div>
        </header>
    <?php } ?>

    <?php function drawFooter()
    { ?>
        <footer>
            LTW Project &copy; 2022
        </footer>
    </body>

    </html>
<?php } ?>

<?php function drawHeaderLogged()
{ ?>
    <!DOCTYPE html>
    <html lang="en-US">

    <head>
        <title>Ifoodclone</title>
        <meta charset="utf-8">
    </head>

    <body>
        <header>
            <div id="menu">
                <a href="../pages/index.php" id="return">Ifoodclone</a>

            </div>
        </header>
    <?php } ?>

    <?php function drawLoginOptions()
    { ?>
        <div id="register">
            <a href="../pages/signup.php" id="signup">Sign Up</a>
            <a href="../pages/login.php" id="login">Login</a>
        </div>
    <?php } ?>

    <?php function drawCartSidenav()
    { ?>
        <script src='../javascript/sidenav.js'></script>
        <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <div class="shopping-cart-header">
                <i class="fa fa-shopping-cart cart-icon"></i><span id="badge" class="badge"></span>
                <div class="shopping-cart-total">
                    <span class="lighter-text">Total:</span>
                    <span class="main-color-text" id="total"></span>
                </div>

            </div>

            <ul class="cartItems">

            </ul>
            <a class="checkout-button" onclick="checkout()">Checkout</a>
        </div>
    <?php } ?>

    <?php function drawLogoutOptions(string $name)
    { ?>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <?= drawCartSidenav() ?>
        <div id="register">
            <a href="/../actions/action_logout.php" onclick="clearSession()" id="signup">Log out</a>
            <a href="/../pages/user_profile.php" id="login"><?= $name ?></a>
            <a onclick="openNav()" id="cart"><i style="font-size:larger" class="fa fa-shopping-cart"></i></a>
        </div>
    <?php } ?>