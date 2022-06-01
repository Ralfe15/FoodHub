<?php

declare(strict_types=1);

session_start();
require_once(__DIR__ . '/../database/connection.db.php');
$db = getDatabaseConnection();

$review_text = $_POST['subject'];
$rating = intval($_POST['rating']);
$idRestaurant = $_POST['idRestaurant'];
$idUser = $_SESSION['id'];
$idOrder = $_POST['idOrder'];

$stmt = $db->prepare("INSERT INTO Review (review, rating, idRestaurant, idUser, idOrder) VALUES (?, ?, ?, ?, ?)");
$stmt->execute(array($review_text, $rating, $idRestaurant, $idUser, $idOrder));

$stmt = $db->prepare("UPDATE user_order SET status='reviewed' where idOrder = ?");
$stmt->execute(array($idOrder));
header('Location: ../pages/user_orders.php');
