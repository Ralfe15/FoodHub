<?php
  declare(strict_types = 1);

  session_start();
  require_once(__DIR__ . '/../database/connection.db.php');

  $db = getDatabaseConnection();

  $restaurant = $_POST['restaurant'];

  if (!is_dir('../images/restaurants')) {
      mkdir('../images/restaurants');
      $logo = 0;
  }
  else{
    $files = scandir(__DIR__ . '/../images/restaurants', SCANDIR_SORT_DESCENDING);
    $logo = intval($files[0]) + 1;   
  }
  
  $stmt = $db->prepare("UPDATE restaurant SET logo = ? WHERE idRestaurant = ?");
  $stmt->execute(array($logo, $restaurant));

  $fileName = "../images/restaurants/" . $logo . ".jpg";

  move_uploaded_file($_FILES['image']['tmp_name'], $fileName);

  header('Location: http://localhost:9000/pages/index.php');
?>