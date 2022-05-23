<?php
  declare(strict_types = 1);

  session_start();
  require_once(__DIR__ . '/../database/connection.db.php');

  $db = getDatabaseConnection();

  $dish = $_POST['dish'];

  if (!is_dir('../images/dishes')) {
      mkdir('../images/dishes');
      $photo = 0;
  }
  else{
    $files = scandir('../images/dishes', SCANDIR_SORT_DESCENDING);
    $photo = intval($files[0]) + 1;   
  }
  
  $stmt = $db->prepare("UPDATE Dish SET photo = ? WHERE idDish = ?");
  $stmt->execute(array($photo, $dish));

  $fileName = "../images/dishes/" . $photo . ".jpg";

  move_uploaded_file($_FILES['image']['tmp_name'], $fileName);
  die();

  header('Location: http://localhost:9000/pages/index.php');
?>