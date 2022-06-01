<?php

declare(strict_types=1);

session_start();

require_once(__DIR__ . '/../templates/common.tpl.php');
require_once(__DIR__ . '/../database/connection.db.php');


drawHeader();

$db = getDatabaseConnection();


if (!isset($_SESSION['id'])) {
    header('Location: http://localhost:9000/pages/login.php');
}

