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


<?php function drawUploadImage() {
  /*
  $db = getDatabaseConnection();

  $stmt = $db->prepare("SELECT * FROM Img ORDER BY idImage DESC");
  $stmt->execute();
  
  $images = $stmt->fetchAll();
?>
    <nav>
      <form action="upload.php" method="post" enctype="multipart/form-data">
        <label>Title:
          <input type="text" name="title">
        </label>
        <input type="file" name="image">
        <input type="submit" value="Upload">
      </form>
    </nav>
    <section id="images">
      <?php foreach ($images as $image) { ?>
      <article class="image">
        <header><h2><?=$image['title']?></h2></header>
        <a href="../pages/view_image.php?id=<?=$image['id']?>">
          <img src="../images/<?=$image['id']?>.jpg" width="200" height="200">
        </a>
      </article>
      <?php } ?>
    </section>
<?php */}  ?>