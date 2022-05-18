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