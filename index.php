<?php 
    declare(strict_types = 1);

    session_start();
    
    require_once('templates/common.tpl.php');
 
    drawHeader("style-landing");
?>
        <img class="logo-home" src="https://manualdeimagem.up.pt/files/uportonegativofundoopaco.jpg" />
        <div id="search-div">
            <form action="search.php" id="search" method = "POST">
                <input type="text" placeholder="Search.." name="search">
                <button type="submit" class="search-button"><i></i>&#x276F</button>
            </form>
            </div>
<?php 
    drawFooter();
?>
