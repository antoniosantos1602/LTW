<?php 

function getDatabaseConnection() {
    $db = new PDO('sqlite:take_away.db');
    return $db;
}

function getRestaurant($id) {
    $db = new PDO('sqlite:database/take_away.db');
    $stmt = $db->prepare('SELECT * FROM restaurants  WHERE id_restaurant = :id');
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $restaurant = $stmt->fetch();
    return $restaurant;
}

function getDishes($id) {
    $db = new PDO('sqlite:database/take_away.db');
    $stmt = $db->prepare('SELECT * FROM dishes  WHERE id_restaurant = :id');
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $dishes = $stmt->fetchAll();
    return $dishes;
}

function getDish($id) {
    $db = new PDO('sqlite:database/take_away.db');
    $stmt = $db->prepare('SELECT * FROM dishes  WHERE id_dish = :id');
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $dish = $stmt->fetch();
    return $dish;
}

function getReviews($id) {
    $db = new PDO('sqlite:database/take_away.db');
    $stmt = $db->prepare('SELECT * FROM reviews JOIN users USING (id_user) WHERE id_restaurant = :id');
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $reviews = $stmt->fetchAll();
    return $reviews;
} 

function getUser($id) {
    $db = new PDO('sqlite:database/take_away.db');
    $stmt = $db->prepare('SELECT * FROM users  WHERE id_user = :id');
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $user = $stmt->fetch();
    return $user;
}

function getOrders($id) {
    $db = new PDO('sqlite:database/take_away.db');
    $stmt = $db->prepare('SELECT o.*, r.name AS rName from orders o JOIN restaurants as r USING (id_restaurant) WHERE id_user = :id');
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $orders = $stmt->fetchAll();
    return $orders;
}

function getRestOrders($id) {
    $db = new PDO('sqlite:database/take_away.db');
    $stmt = $db->prepare('SELECT o.*, u.username AS uName from orders o JOIN users as u USING (id_user) WHERE id_restaurant = :id');
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $orders = $stmt->fetchAll();
    return $orders;
}

function getDishes_order($id) {
    $db = new PDO('sqlite:database/take_away.db');
    $stmt = $db->prepare('SELECT dio.*, d.name AS dName from dishes_in_orders dio JOIN dishes as d USING (id_dish) WHERE id_order = :id');
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $dishes = $stmt->fetchAll();
    return $dishes;
}

function getDriver($id) {
    $db = new PDO('sqlite:database/take_away.db');
    $stmt = $db->prepare('SELECT u.username as uName, d.registration as dRegist from drivers d JOIN users u USING (id_user) WHERE id_user = :id;');
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $driver = $stmt->fetch();
    return $driver;
}
    
?>