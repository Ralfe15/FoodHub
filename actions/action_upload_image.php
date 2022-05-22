<?php
  $db = getDatabaseConnection();

  $title = $_POST['title'];
  $type = $_POST['type'];
  $fid = $_POST['fid'];
  $stmt = $db->prepare("INSERT INTO Img VALUES(NULL, ?, ?, ?, ?, ?)");
  if($type == 0){
    $stmt->execute(array($title, $type, $fid, NULL, NULL));
  }
  else if($type == 1){
    $stmt->execute(array($title, $type, NULL, $fid, NULL));
  }
  else{
    $stmt->execute(array($title, $type, NULL, NULL, $fid));
  }
  $id = $db->lastInsertId();

  if (!is_dir('../images')) mkdir('../images');

  $originalFileName = "../images/" . $id . ".jpg";

  move_uploaded_file($_FILES['image']['tmp_name'], $originalFileName);
  die();

  header("Location: ../pages/index.php");
?>