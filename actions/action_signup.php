<?php
  declare(strict_types = 1);

  session_start();
  require_once(__DIR__ . '/../database/connection.db.php');

  $db = getDatabaseConnection();

  $username = $_POST["email"];
  $password = $_POST["password"];
  $name = $_POST["name"];
  $phone = $_POST["phone"];
  $address = $_POST["address"];


  $stmt = $db->prepare('Insert into User (name, email, phone, address, password) VALUES (?, ?, ?, ?, ?)');
  $stmt -> execute(array($name, $username, $phone, $address, $password));

  header('Location: http://localhost:9000/pages/index.php');

