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

  ?>