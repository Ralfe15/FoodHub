<?php
  declare(strict_types = 1);

  session_start();
  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../templates/restaurant.tpl.php');
  require_once(__DIR__ . '/../templates/images.tpl.php');


  $db = getDatabaseConnection();
  $id = $_POST['id'];
  $name = $_POST['name'];
  $category = $_POST['category'];
  $address = $_POST['address'];
  $isowner = isOwner($id);
  if(!$isowner){
    header('Location: http://localhost:9000/pages/index.php');
  }
  if(!empty($name)){
    $stmt = $db->prepare("Update Restaurant set name = ? where idRestaurant = ?");
    $stmt->execute(array($name, $id));
  }
  if(!empty($category)){
    $stmt = $db->prepare("Update Restaurant set category = ? where idRestaurant = ?");
    $stmt->execute(array($category, $id));
  }
  if(!empty($address)){
    $stmt = $db->prepare("Update Restaurant set address = ? where idRestaurant = ?");
    $stmt->execute(array($address, $id));
  }
  if(is_uploaded_file($_FILES['image']['tmp_name'])){
    $stmt = $db->prepare("Select * from Restaurant where idRestaurant = ?");
    $stmt->execute(array($id));
    $result = $stmt->fetchAll();
    $fileName = $result[0]['logo'];
    deleteRestaurantImage($fileName);

    $path = "../images/restaurant/originals/" . $fileName . ".jpg";
    move_uploaded_file($_FILES['image']['tmp_name'], $path);
    createResizedRestaurantImages($fileName);
  }

  header('Location: http://localhost:9000/pages/profile.php?res=' . $id);
?>