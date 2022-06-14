<?php
  declare(strict_types = 1);
  function rowid_compare($element1, $element2) {
    $x1 = ($element1['rowid']);
    $x2 = ($element2['rowid']);
    return $x2 - $x1;
} 
function rowid_compare_reverse($element1, $element2) {
  $x1 = ($element1['rowid']);
  $x2 = ($element2['rowid']);
  return $x1 - $x2;
} 

function rating_compare($r1, $r2) {
  require_once(__DIR__ . '/../database/connection.db.php');

  $db = getDatabaseConnection();

  $stmt = $db->prepare('Select avg(rating) as rating from review where idRestaurant = ?');
  $stmt->execute(array($r1['idRestaurant']));
  $rating1 = $stmt->fetch();

  $stmt = $db->prepare('Select avg(rating) as rating from review where idRestaurant = ?');
  $stmt->execute(array($r2['idRestaurant']));
  $rating2 = $stmt->fetch();

  if ($rating1 == $rating2) {
      return 0;
  }
  return ($rating1 < $rating2) ? 1 : -1;
} 

  ?>