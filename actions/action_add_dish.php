<?php
  declare(strict_types = 1);

  session_start();
  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../templates/images.tpl.php');

  $db = getDatabaseConnection();

  $res = $_POST['idRestaurant'];
  $name = $_POST['name'];
  $category = $_POST['category'];
  $price = $_POST['price'];
  $price = str_replace(".", ",", $price);
    if(strpos($price, ",") == false)
      $price = $price . ",00";
  
  $fileName = NULL;
  if(is_uploaded_file($_FILES['image']['tmp_name'])){
    $fileName = calculateImageName("dish");
    $path = "../images/dish/originals/" . $fileName . ".jpg";
    move_uploaded_file($_FILES['image']['tmp_name'], $path);
    createResizedDishImages($fileName);
  }
  $stmt = $db->prepare("Insert into Dish values (NULL, ?, ?, ?, ?, ?)");
  $stmt->execute(array($res, $name, $price, $category, $fileName));

  header('Location: http://localhost:9000/pages/profile.php?res=' . $res);
?>