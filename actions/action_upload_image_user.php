<?php
  declare(strict_types = 1);

  session_start();
  require_once(__DIR__ . '/../database/connection.db.php');

  $db = getDatabaseConnection();

  $user = $_POST['user'];

  if (!is_dir('../images/users')) {
      mkdir('../images/users');
      $avatar = 0;
  }
  else{
    $files = scandir(__DIR__ . '/../images/users', SCANDIR_SORT_DESCENDING);
    $avatar = intval($files[0]) + 1;   
  }
  
  $stmt = $db->prepare("UPDATE user SET avatar = ? WHERE iduser = ?");
  $stmt->execute(array($avatar, $user));

  $fileName = "../images/users/" . $avatar . ".jpg";

  move_uploaded_file($_FILES['image']['tmp_name'], $fileName);

  header('Location: http://localhost:9000/pages/index.php');
?>