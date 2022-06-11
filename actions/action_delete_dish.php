<?php
  declare(strict_types = 1);

  session_start();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../templates/restaurant.tpl.php');
  require_once(__DIR__ . '/../templates/images.tpl.php');
  
  $idDish = $_POST['id'];
  $idRestaurant = $_POST['idRestaurant'];
  $isowner = isOwner($idRestaurant);
  if(!$isowner){
    header('Location: http://localhost:9000/pages/index.php?');
  }

  $db = getDatabaseConnection();
  $stmt = $db->prepare('Select * from Dish where idDish = ?');
  $stmt->execute(array($idDish));
  $results = $stmt->fetchAll();
  $idImage = $results[0]['photo'];
  deleteDishImage($idImage);

  $stmt = $db->prepare('Delete from Dish where idDish = ?');
  $stmt->execute(array($idDish));

  header('Location: http://localhost:9000/pages/profile.php?res=' . $idRestaurant);
?>