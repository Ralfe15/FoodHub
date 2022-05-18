<?php
  declare(strict_types = 1);
  session_start();
  require_once('templates/common.tpl.php');
  require_once('database/connection.db.php');


  if (!isset($_SESSION['id'])) header('Location: http://localhost:9000/login.php');;
  drawHeader('login');
  
  $db = getDatabaseConnection();

  $id = $_SESSION['id'];
  $stmt = $db->prepare('Select * from user where idUser = ?');
  $stmt -> execute(array($id));
  $result = $stmt->fetchAll();
  ?>
  <h1 style="text-align: center;">Edit profile </h1>
  <div class="form-login">
  <form action="action_update_profile.php" method="post">
  <?php 
  unset($result[0]['idUser']); //we dont want do display this
  foreach($result[0] as $field => $value){
      switch($field){
          case 'name': $type = 'text'; break;
          case 'email': $type = 'email'; break;
          case 'phone': $type = 'tel'; break;
          case 'address': $type = 'text'; break;
          case 'password': $type = 'password'; break;
          default: $type = 'text'; break;
      }
      ?>
      <p>
      <label><?=ucfirst($field)?>:</label>
    <input type=<?=$type?> required name="<?=$field?>" value="<?=$value?>" />
    </p>
  <?php
  }
  ?>
  <button type="submit">Edit profile</button>
  </form>
  </div>
  

