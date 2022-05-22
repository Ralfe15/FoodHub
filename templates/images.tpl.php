<?php function drawImage(int $id) {
  $db = getDatabaseConnection();

  $stmt = $db->prepare("SELECT * FROM images WHERE id = ?");
  $stmt->execute(array($id));
  
  $image = $stmt->fetch();
?>
    <article class="image single">
      <header><h2><?=$image['title']?></h2></header>
      <a href="images/originals/<?=$image['id']?>.jpg">
        <img src="images/thumbs_medium/<?=$image['id']?>.jpg">
      </a>
    </article>
<?php }?>


<?php function drawUploadImage() {
  $db = getDatabaseConnection();

  $stmt = $db->prepare("SELECT * FROM images ORDER BY id DESC");
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
<?php }?>