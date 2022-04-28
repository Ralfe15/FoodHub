<?php 
require_once('templates/common.tpl.php');

drawHeaderLogged("login");
?>
<form id="form_login">
  <p> 
      <input type="text" id="username" placeholder="username" />
  </p>
  <p>
      <input type="password" id="password" placeholder="password" />
  </p>
  <p>
      <button id="submitbutton" type="button">Login</button>
  </p>
</form>
<?=drawFooter();?>
