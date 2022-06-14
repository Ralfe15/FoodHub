<?php 
declare(strict_types = 1);

function getRestaurantsByName(PDO $db, string $search, int $count) : array {
    $stmt = $db->prepare('SELECT * FROM Restaurant WHERE Name LIKE ? LIMIT ?');
    $stmt->execute(array('%' . $search . '%', $count));
    $restaurants = $stmt->fetchAll();
    return $restaurants;
}

// function getRestaurantsByDish(PDO $db, string $search, int $count) : array {
//     $stmt = $db->prepare('SELECT * FROM Restaurant WHERE Name LIKE ? LIMIT ?');
//     $stmt->execute(array($search . '%', $count));
//     $restaurants = $stmt->fetchAll();
//     return $restaurants;
// }

function getRestaurantsByAddress(PDO $db, string $search, int $count) : array {
    $stmt = $db->prepare('SELECT * FROM Restaurant WHERE address LIKE ? LIMIT ?');
    $stmt->execute(array('%' . $search . '%', $count));
    $restaurants = $stmt->fetchAll();
    return $restaurants;
}

function getDishPriceHistory(PDO $db, string $search) : array {
    $stmt = $db->prepare('SELECT * FROM Dish_price_history where idDish=?');
    $stmt->execute(array($search));
    $dishes = $stmt->fetchAll();
    return $dishes;
}

function getDishes(PDO $db): array {
    $stmt = $db->prepare('SELECT name, idDish, price FROM Dish');
    $stmt->execute(array());
    $dishes = $stmt->fetchAll();
    return $dishes;
}

function getDishesByMaxPrice(PDO $db, string $maxprice): array {
    $stmt = $db->prepare('SELECT name, idDish, price FROM Dish where CAST(price as FLOAT) < ?');
    $stmt->execute(array(floatval($maxprice)));
    $dishes = $stmt->fetchAll();
    return $dishes;
}

function getRestaurantByRating(PDO $db, string $minrating): array{
    $stmt = $db->prepare('Select restaurant.name, review.idRestaurant, avg(rating) as rating from review join restaurant on restaurant.idRestaurant = review.idRestaurant where rating >= ?');
    $stmt->execute(array($minrating));
    $dishes = $stmt->fetchAll();
    if($dishes[0]['rating'] == null){
        return [];
    }
    return $dishes;
}