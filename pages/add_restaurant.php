<?php
session_start();
require_once(__DIR__ . '/../templates/common.tpl.php');

drawHeader();
?>
<head>
    <link rel="stylesheet" href="../styles/common.css">
</head>
<h1 style="text-align: center;">Create Restaurant</h1>
<div class="form">
    <form action="../actions/action_create_restaurant.php" method="post" id="form_add_restaurant" enctype="multipart/form-data">
            <p>
                <input type="text" required name="name" placeholder="name" />
            </p>
            <p>
                <input type="text" required name="category" placeholder="category" />
            </p>
            <p>
                <input type="text" required name="address" placeholder="address" />
            </p>
            <p>
                <label>Restaurant Logo:</label>
            </p>
            <p>
                <input type="file" required name="image" title="Logo:">
            </p>
            <p>
                <button type="submit">Create</button>
            </p>
        </form>
</div>
<?=drawFooter();?>