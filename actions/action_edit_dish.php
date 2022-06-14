<?php
  declare(strict_types = 1);

  session_start();
  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../templates/restaurant.tpl.php');


  $db = getDatabaseConnection();
  $id = $_POST['id'];
  $idRestaurant = $_POST['idRestaurant'];
  $name = $_POST['name'];
  $category = $_POST['category'];
  $price = $_POST['price'];

  $isowner = isOwner($idRestaurant);
  if(!$isowner){
    header('Location: http://localhost:9000/pages/index.php');
  }

  if(!empty($name)){
    $stmt = $db->prepare("Update Dish set name = ? where idDish = ?");
    $stmt->execute(array($name, $id));
  }
  if(!empty($category)){
    $stmt = $db->prepare("Update Dish set category = ? where idDish = ?");
    $stmt->execute(array($category, $id));
  }
  if(!empty($price)){
    $price = str_replace(",", ".", $price);
    if(strpos($price, ".") == false)
      $price = $price . ".00";
    $stmt = $db->prepare("Select price from Dish where idDish = ?");
    $stmt->execute(array($id));
    $prevPrice = $stmt->fetch();
    $stmt = $db->prepare("Update Dish set price = ? where idDish = ?");
    $stmt->execute(array($price, $id));
    $date = date('Y-m-d H:i:s');
    $stmt = $db->prepare("Insert into Dish_price_history values (?, ?, ?, ?)");
    $stmt->execute(array($id, $prevPrice['price'],$price, $date));
    
  }
  if(is_uploaded_file($_FILES['image']['tmp_name'])){
    require_once(__DIR__ . '/../templates/images.tpl.php');
    $stmt = $db->prepare("Select * from Dish where idDish = ?");
    $stmt->execute(array($id));
    $result = $stmt->fetchAll();
    $photo_id = $result[0]['photo'];
    if(!empty($photo_id)){
      deleteDishImage($photo_id);
    }
    else{
      $photo_id = calculateImageName("dish");
      $stmt = $db->prepare('Update Dish SET photo = ? WHERE idDish = ?');
      $stmt -> execute(array($photo_id, $id));
    }

    $path = "../images/dish/originals/" . $photo_id . ".jpg";
    move_uploaded_file($_FILES['image']['tmp_name'], $path);
    createResizedDishImages($photo_id);
  }

  header('Location: http://localhost:9000/pages/profile.php?res=' . $idRestaurant);
