<?php
  declare(strict_types = 1);

  session_start();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../templates/restaurant.tpl.php');
  require_once(__DIR__ . '/../templates/images.tpl.php');
  
  $id = $_POST['id'];
  $isowner = isOwner($id);
  if(!$isowner){
    header('Location: http://localhost:9000/pages/index.php?');
  }

  $db = getDatabaseConnection();
  $stmt = $db->prepare('Select * from Restaurant where idRestaurant = ?');
  $stmt->execute(array($id));
  $results = $stmt->fetchAll();
  $idImage = $results[0]['logo'];
  deleteRestaurantImage($idImage);

  $stmt = $db->prepare('Select * from Dish where idRestaurant = ?');
  $stmt->execute(array($id));
  $results = $stmt->fetchAll();
  foreach($results as $dish){
    $idImage = $dish['photo'];
    deleteDishImage($idImage);
  }

  $stmt = $db->prepare('Delete from Restaurant where idRestaurant = ?');
  $stmt->execute(array($id));

  header('Location: http://localhost:9000/pages/manage_restaurants.php');
?>