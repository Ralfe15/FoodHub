<?php 
    declare(strict_types = 1);

    session_start();
    
    require_once(__DIR__ . '/../templates/common.tpl.php');
 
    drawHeader();
?>
<html>
    <head>
        <link rel="stylesheet" href="../styles/style-landing.css">
    </head>
    <body>
        <img class="logo-home" src="https://manualdeimagem.up.pt/files/uportonegativofundoopaco.jpg" />
        <div id="search-div">
            <form action="../pages/search.php" id="search" method = "POST">
                <input type="text" placeholder="Search.." name="search">
                <button type="submit" class="search-button"><i></i>&#x276F</button>
            </form>
        </div>
        <?php if(isset($_SESSION['id'])) {?>
        <div class="button-wrapper">
            <a class="fcc-btn" href='../pages/user_orders.php'>Your orders</a>
        </div>  
        <?php
    }
    ?>
    </body>
</html>
<?php 
    drawFooter();
?>
