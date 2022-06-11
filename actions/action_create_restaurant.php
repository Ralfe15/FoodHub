<?php
  declare(strict_types = 1);

  session_start();
  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../templates/images.tpl.php');

  $db = getDatabaseConnection();

  $name = $_POST['name'];
  $category = $_POST['category'];
  $address = $_POST['address'];
  
  $fileName = calculateImageName("restaurant");
  $stmt = $db->prepare("Insert into Restaurant values (NULL, ?, ?, ?, ?)");
  $stmt->execute(array($name, $category, $address, $fileName));
  $stmt = $db->prepare("Select * from Restaurant ORDER BY idRestaurant DESC");
  $stmt->execute();
  $idRestaurant = $stmt->fetchAll()[0]['idRestaurant'];
  $stmt = $db->prepare("Insert into Restaurant_owner values (NULL, ?, ?)");
  $stmt->execute(array($idRestaurant, $_SESSION['id']));

  $path = '../images/restaurant/originals/' . $fileName . '.jpg';
  move_uploaded_file($_FILES['image']['tmp_name'], $path);
  createResizedRestaurantImages($fileName);

  header('Location: http://localhost:9000/pages/profile.php?res=' . $idRestaurant);
?>