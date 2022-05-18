<?php 
session_start();
require_once('templates/common.tpl.php');

drawHeader("login");
?>
<div class="title">
<h1>Sign up</h1>
</div>
<div class="form-login">
<form action="action_signup.php" method="post" id="form_login">
<p> 
      <input type="text" required name="name" placeholder="name" />
  </p>
  <p> 
      <input type="email" required name="email" placeholder="email" />
  </p>
  <p>
      <input type="password" required name="password" placeholder="password" />
  </p>
  <p>
      <input type="password" required name="password-confirmation" placeholder="repeat password" />
  </p>
  <p>
      <input type="tel" required name="phone" placeholder="phone" />
  </p>
  <p>
      <input type="text" required name="address" placeholder="address" />
  </p>
  <p>
      <button type="submit">Sign up</button>
  </p>
</form>
</div>
<?=drawFooter();?>
