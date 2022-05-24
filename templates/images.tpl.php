<?php function drawImage(string $type, int $id) {
  $db = getDatabaseConnection();

  $stmt = $db->prepare("SELECT * FROM ? WHERE ? = ?");
  if($type == 'dish') $column = 'photo';
  else if($type == 'user') $column = 'avatar';
  else $column = 'logo';
  $stmt->execute(array($type, $column, $id));
  
  $image = $stmt->fetch();
?>
    <article class="image single">
      <a href="../images/<?=$type?>es/<?=$image[$column]?>.jpg">
        <img src="../images/<?=$type?>es/<?=$image[$column]?>.jpg">
      </a>
    </article>
<?php }?>
