<?php
  declare(strict_types = 1);
  session_start();
  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/queries.db.php');

  $db = getDatabaseConnection();

  $type = (isset($_GET['type'])) ? $_GET['type'] : "";
  $search = (isset($_GET['search'])) ? $_GET['search'] : "";

  switch($type){
      case 'name': $restaurants = getRestaurantsByName($db, $search, 8); echo json_encode($restaurants); die();
      case 'address': $restaurants = getRestaurantsByAddress($db, $search, 8); echo json_encode($restaurants); die();
      case 'history': $dishes = getDishPriceHistory($db, $search); echo json_encode($dishes); die();
      case 'dishes': $dishes = getDishes($db); echo json_encode($dishes); die();
      case 'price': $dishes = getDishesByMaxPrice($db, $search); echo json_encode($dishes); die();
      case 'rating': $restaurants = getRestaurantByRating($db, $search); echo json_encode($restaurants); die();
      default: $restaurants = []; echo json_encode($restaurants); die();
  }
  