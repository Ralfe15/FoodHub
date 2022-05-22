<?php
  declare(strict_types = 1);

  session_start();
  require_once(__DIR__ . '/../database/connection.db.php');

  $db = getDatabaseConnection();

  $username = $_POST["email"];
  $password = $_POST["password"];

  $stmt = $db->prepare('Select * from user where email = ? and password = ?');
  $stmt -> execute(array($username, $password));
  $result = $stmt->fetchAll();

  if ($result) {
    $_SESSION['id'] = $result[0]["idUser"];
    $_SESSION['name'] =  $result[0]["name"];
    header('Location: http://localhost:9000/pages/index.php?');
  }
  else{
    header('Location: http://localhost:9000/pages/login.php?success=false');
}
?>
  

