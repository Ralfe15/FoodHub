<?php declare(strict_types = 1); ?>

<?php function drawHeader($style) { ?> 
<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>Ifoodclone</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="styles/<?=$style?>.css">
</head>

<body>
    <header>
        <div id="menu">
            <a href="index.php" id="return">Ifoodclone</a>
            <div id="register">
                <a href="signup.php" id="signup">Sign Up</a>
                <a href="login.php" id="login">Login</a>
            </div>
        </div>
    </header>

<?php }?>

<?php function drawFooter() { ?>
</main>
<footer>
    LTW Project &copy; 2022
</footer>
</body>
</html>
<?php }?>

<?php function drawHeaderLogged($style) { ?>
    <!DOCTYPE html>
<html lang="en-US">
<head>
    <title>Ifoodclone</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="styles/<?=$style?>.css">
</head>

<body>
    <header>
        <div id="menu">
            <a href="index.php" id="return">Ifoodclone</a>
            
        </div>
    </header>
<?php }?>
