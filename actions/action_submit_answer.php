<?php

declare(strict_types=1);

session_start();
require_once(__DIR__ . '/../database/connection.db.php');
$db = getDatabaseConnection();

$idOrder = $_POST['idOrder'];
$review_text = $_POST['subject'];

$stmt = $db->prepare("INSERT INTO Review_answer (answer, idOrder) VALUES (?, ?)");
$stmt->execute(array($review_text, $idOrder));

$stmt = $db->prepare("UPDATE user_order SET status='answered' where idOrder = ?");
$stmt->execute(array($idOrder));
header('Location: ../pages/owner_orders.php?res='.$_POST['res']);