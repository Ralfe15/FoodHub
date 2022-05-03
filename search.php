
<?php 
    require_once('templates/common.tpl.php');
    drawHeader("style-search");
?>

<html lang="en-US">

<head>
    <title>Ifoodclone</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="styles/style-search.css">
</head>

<body>
    <div class="search-bar-home">
        <form action="profile.php" method="get">
            <input type="text" placeholder="Search.." name="search">
            <button type="submit" class="search-button"><i></i>&#x276F</button
        </form>
    </div>
    
    <main>
        <section id="results-grid">
            <article>
                <img src="https://www.citypng.com/public/uploads/preview/-11600735522qbwj7xtpxu.png" width="50" height="50">
                <h2>McDonalds Areosa</h2>
                <h3>Fast Food</h3>
                <h4>From $2.99</h4>
                <img src=https://thumbs.dreamstime.com/z/imagem-do-%C3%ADcone-de-estrelas-83946136.jpg" width="50" height="50"
            </article>
            <article>
                <img src="https://www.citypng.com/public/uploads/preview/-11600735522qbwj7xtpxu.png" width="50" height="50">
                <h2>McDonalds Areosa</h2>
                <h3>Fast Food</h3>
                <h4>From $2.99</h4>
                <img src=https://thumbs.dreamstime.com/z/imagem-do-%C3%ADcone-de-estrelas-83946136.jpg" width="50" height="50"
            </article>
            <article>
                <img src="https://www.citypng.com/public/uploads/preview/-11600735522qbwj7xtpxu.png" width="50" height="50">
                <h2>McDonalds Areosa</h2>
                <h3>Fast Food</h3>
                <h4>From $2.99</h4>
                <img src=https://thumbs.dreamstime.com/z/imagem-do-%C3%ADcone-de-estrelas-83946136.jpg" width="50" height="50"
            </article>
        </section>
    </main>
</body>
<?=drawFooter();?>

</html>