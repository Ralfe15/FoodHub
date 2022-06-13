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

  $stmt = $db->prepare('Update User SET name = ?, email = ?, phone = ?, address = ? WHERE idUser = ?');
  $stmt -> execute(array($name, $username, $phone, $address, $id));
  $_SESSION['name'] = $name;
  header('Location: http://localhost:9000/pages/index.php'); 
  ?>
