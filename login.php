<?php 
session_start();
require_once('templates/common.tpl.php');

drawHeader("login");
?>
<div class="title">
<h1>Login page</h1>
</div>
<form action="action_login.php" method="post" id="form_login">
  <p> 
      <input type="text" required name="email" placeholder="username" />
  </p>
  <p>
      <input type="password" required name="password" placeholder="password" />
  </p>
  <p>
      <button type="submit">Login</button>
  </p>
</form>
<?=drawFooter();?>
