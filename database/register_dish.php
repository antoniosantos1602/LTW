<?php
    if (session_status()===PHP_SESSION_NONE) session_start();
    
    require_once('connection.php');

    $db = getDatabaseConnection();

    $name = $_POST["name"];
    $stmt = $db->prepare('SELECT * FROM dishes WHERE name=?');
    $stmt->execute([$name]);
    $check = $stmt->fetch();
    if ($check) {
        $_SESSION['message'] = "Nome já existe";
        header('Location: ../create_dish.php');
        exit();
    }

    $price = $_POST["price"];
    $photo = $_POST["photo"];

    if ($photo==null) {
        $stmt = $db->prepare('INSERT INTO dishes (id_restaurant, name, price)
                            VALUES (:id_restaurant, :name, :price)');
        $stmt->bindParam(':id_restaurant', $_SESSION['id_restaurant']);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->execute();
    }

    else {
        $stmt = $db->prepare('INSERT INTO dishes (id_restaurant, name, price, photo)
                            VALUES (:id_restaurant, :name, :price, :photo)');
        $stmt->bindParam(':id_restaurant', $_SESSION['id_restaurant']);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':photo', $photo);
        $stmt->execute();
    }

    header('Location: ../restaurant.php?id=' . $_SESSION['id_restaurant']);
    exit;

?>