<?php
  declare(strict_types = 1);

  session_start();
  require_once(__DIR__ . '/../database/connection.db.php');

  $db = getDatabaseConnection();

  $name = $_POST['name'];
  $category = $_POST['category'];
  $address = $_POST['address'];

  if (!is_dir('../images/restaurants')) {
      mkdir('../images/restaurants');
      $logo_id = 0;
  }
  else{
    $files = scandir(__DIR__ . '/../images/restaurants', SCANDIR_SORT_DESCENDING);
    $logo_id = intval($files[0]) + 1;   
  }
  
  $stmt = $db->prepare("Insert into Restaurant values (NULL, ?, ?, ?, ?)");
  $stmt->execute(array($name, $category, $address, $logo_id));
  $stmt = $db->prepare("Select * from Restaurant ORDER BY idRestaurant DESC");
  $stmt->execute();
  $idRestaurant = $stmt->fetchAll()[0]['idRestaurant'];
  $stmt = $db->prepare("Insert into Restaurant_owner values (NULL, ?, ?)");
  $stmt->execute(array($idRestaurant, $_SESSION['id']));

  $fileName = "../images/restaurants/" . $logo_id . ".jpg";

  move_uploaded_file($_FILES['image']['tmp_name'], $fileName);

  header('Location: http://localhost:9000/pages/manage_restaurants.php');
?>