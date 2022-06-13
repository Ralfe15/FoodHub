<?php function calculateImageName(string $type) : int {
  if(!is_dir('../images')){
    mkdir('../images');
  }
  if (!is_dir('../images/' . $type)) {
    mkdir('../images/' . $type);
  }
  if (!is_dir('../images/' . $type . '/originals')) {
    mkdir('../images/' . $type . '/originals');
    $logo = 0;
  }
  else{
    $files = scandir(__DIR__ . '/../images/' . $type . '/originals', SCANDIR_SORT_DESCENDING);
    $logo = intval($files[0]) + 1;   
  }
  return $logo;
}?>


<?php function deleteRestaurantImage($id) {
  $originalFileName = "../images/restaurant/originals/" . $id . ".jpg";
  $smallFileName = "../images/restaurant/small/" . $id . ".jpg";
  $mediumFileName = "../images/restaurant/medium/" . $id . ".jpg";
  unlink($originalFileName);
  unlink($smallFileName);
  unlink($mediumFileName);
}?>


<?php function deleteDishImage($id) {
  $originalFileName = "../images/dish/originals/" . $id . ".jpg";
  $smallFileName = "../images/dish/small/" . $id . ".jpg";
  $mediumFileName = "../images/dish/medium/" . $id . ".jpg";
  unlink($originalFileName);
  unlink($smallFileName);
  unlink($mediumFileName);
}?>


<?php function createResizedRestaurantImages($fileName){
  if (!is_dir('../images/restaurant/medium')) {
    mkdir('../images/restaurant/medium');
  }

  $originalFileName = "../images/restaurant/originals/" . $fileName . ".jpg";
  $mediumFileName = "../images/restaurant/medium/" . $fileName . ".jpg";

  $original = imagecreatefromjpeg($originalFileName);

  if (!$original) die();

  $width = imagesx($original);     // width of the original image
  $height = imagesy($original);    // height of the original image
  $square = min($width, $height);  // size length of the maximum square

  // Calculate width and height of medium sized image (max width: 400)
  $medium = imagecreatetruecolor(200, 200);
  imagecopyresized($medium, $original, 0, 0, ($width>$square)?($width-$square)/2:0, ($height>$square)?($height-$square)/2:0, 200, 200, $square, $square);
  imagejpeg($medium, $mediumFileName);
}?>


<?php function createResizedDishImages($fileName){
  if (!is_dir('../images/dish/medium')) {
    mkdir('../images/dish/medium');
  }
  if (!is_dir('../images/dish/small')) {
    mkdir('../images/dish/small');
  }

  $originalFileName = "../images/dish/originals/" . $fileName . ".jpg";
  $mediumFileName = "../images/dish/medium/" . $fileName . ".jpg";
  $smallFileName = "../images/dish/small/" . $fileName . ".jpg";

  $original = imagecreatefromjpeg($originalFileName);

  if (!$original) die();

  $width = imagesx($original);     // width of the original image
  $height = imagesy($original);    // height of the original image
  $square = min($width, 2*$height);  // size length of the maximum square

  $medium = imagecreatetruecolor(400, 200);
  imagecopyresized($medium, $original, 0, 0, ($width>$square)?($width-$square)/2:0, (2*$height>$square)?(2*$height-$square)/4:0, 400, 200, $square, $square/2);
  imagejpeg($medium, $mediumFileName);

  $square = min($width, $height);
  $small = imagecreatetruecolor(200, 200);
  imagecopyresized($small, $original, 0, 0, ($width>$square)?($width-$square)/2:0, ($height>$square)?($height-$square)/2:0, 200, 200, $square, $square);
  imagejpeg($small, $smallFileName);
}?>
