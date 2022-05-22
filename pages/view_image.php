<?php 
declare(strict_types = 1);
session_start();

require_once(__DIR__ . '/../templates/common.tpl.php');
require_once(__DIR__ . '/../database/connection.db.php');

$id = $_GET['id'];
?>

<?php
drawHeader();
drawImage($id);
drawFooter();
?>