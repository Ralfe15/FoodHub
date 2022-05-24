<?php
  declare(strict_types = 1);
  require_once(__DIR__ . '/../database/connection.db.php');
  //returns true if user exists in db
  function checkCanCreate(string $username) {
    $db = getDatabaseConnection();
    $stmt = $db->prepare('Select * from user where email = ?');
    $stmt -> execute(array(strtolower($username)));
    $result = $stmt->fetchAll();
    if(empty($result)){
        return true;
    } 
    return false;
  }