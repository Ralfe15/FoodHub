<?php
  declare(strict_types = 1);

  session_start();
  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../utils/credential_utils.php');

  $db = getDatabaseConnection();

  $username = $_POST["email"];
  $password = $_POST["password"];
  $name = $_POST["name"];
  $phone = $_POST["phone"];
  $address = $_POST["address"];

  if(checkCanCreate($username)){
  $stmt = $db->prepare('Insert into User (name, email, phone, address, password) VALUES (?, ?, ?, ?, ?)');
  $stmt -> execute(array($name, strtolower($username), $phone, $address, password_hash($password, PASSWORD_DEFAULT)));
  header('Location: http://localhost:9000/pages/index.php');
  }
  else{
    header('Location: http://localhost:9000/pages/signup.php?success=false');
  }
