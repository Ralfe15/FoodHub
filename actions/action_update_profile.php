<?php
  declare(strict_types = 1);

  session_start();
  require_once(__DIR__ . '/../database/connection.db.php');

  $db = getDatabaseConnection();

  $username = $_POST["email"];
  $name = $_POST["name"];
  $phone = $_POST["phone"];
  $address = $_POST["address"];
  $id = $_SESSION['id'];
  if(is_uploaded_file($_FILES['avatar']['tmp_name'])){
    require_once(__DIR__ . '/../templates/images.tpl.php');
    $stmt = $db->prepare("Select * from User where idUser = ?");
    $stmt->execute(array($id));
    $result = $stmt->fetchAll();
    $avatar_id = $result[0]['avatar'];
    if(!empty($avatar_id)){
      deleteAvatarImage($avatar_id);
    }
    else{
      $avatar_id = calculateImageName("user");
      $stmt = $db->prepare('Update User SET avatar = ? WHERE idUser = ?');
      $stmt -> execute(array($avatar_id, $id));
    }
    $path = "../images/user/originals/" . $avatar_id . ".jpg";
    move_uploaded_file($_FILES['avatar']['tmp_name'], $path);
    createResizedAvatars($avatar_id);
  }

  $stmt = $db->prepare('Update User SET name = ?, email = ?, phone = ?, address = ? WHERE idUser = ?');
  $stmt -> execute(array($name, $username, $phone, $address, $id));
  $_SESSION['name'] = $name;
  header('Location: http://localhost:9000/pages/index.php'); 
  ?>
