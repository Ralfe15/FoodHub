<?php

declare(strict_types=1);

session_start();

require_once(__DIR__ . '/../templates/common.tpl.php');

drawHeader();
?>
<html>

<head>
    <link rel="stylesheet" href="../styles/style-landing.css">
    <script src="/../javascript/toggle_search.js"></script>

</head>

<body>
    <img class="logo-home" src="https://manualdeimagem.up.pt/files/uportonegativofundoopaco.jpg" />
    <div id="search-div">
        <form action="../pages/search.php" id="search" method="POST">
            <input type="text" placeholder="Search.." name="search">
            <input type="text" id="search-type" name="search-type" style="display:none" value="restaurant">      
            <button type="submit" class="search-button"><i></i>&#x276F</button>      
        </form>
    </div>
    <div class="search-by">
            <span>By:</span>
            <input type="radio" name="select" id="option-1" value = "restaurant" checked onclick="toggleSearch()">
            <input type="radio" name="select" id="option-2" value= "dish" onclick="toggleSearch()">
            <label for="option-1" class="option option-1" name="restaurant">
                <div class="dot"></div>
                <span>Restaurant</span>
            </label>
            <label for="option-2" class="option option-2" name="dish">
                <div class="dot"></div>
                <span>Dish</span>
            </label>
        </div>
    <?php if (isset($_SESSION['id'])) { ?>
        <div class="button-wrapper">
            <a class="fcc-btn" href='../pages/user_orders.php'>Your orders</a>
            <a class="fcc-btn" href='../pages/favorite_restaurants.php'>Your favorite restaurants</a>
            <a class="fcc-btn" href='../pages/favorite_dishes.php'>Your favorite dishes</a>
        </div>
    <?php
    }
    ?>
</body>

</html>
<?php
drawFooter();
?>