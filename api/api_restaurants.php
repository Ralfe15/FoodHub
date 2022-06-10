<?php
  declare(strict_types = 1);
  session_start();
  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/queries.db.php');

  $db = getDatabaseConnection();

  $type = $_GET['type'];
  $search = $_GET['search'];

  switch($type){
      case 'name': $restaurants = getRestaurantsByName($db, $search, 8); echo json_encode($restaurants); die();
      case 'address': $restaurants = getRestaurantsByAddress($db, $search, 8); echo json_encode($restaurants); die();
      default: $restaurants = []; echo json_encode($restaurants); die();
  }
  