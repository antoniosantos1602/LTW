<?php
    if (session_status()===PHP_SESSION_NONE) session_start();
    
    require_once('connection.php');

    $db = getDatabaseConnection();

    $id_product = $_POST["id_product"];
    $type = $_POST["type"];
    $id_user = $_POST['id_user'];
    $function = $_POST['function'];
   
    if ($type==1) {
        if ($function==1) {
            $stmt = $db->prepare('INSERT INTO favourite_restaurants (id_user, id_restaurant)
                                VALUES (:id_user, :id_restaurant)');
            $stmt->bindParam(':id_user', $id_user);
            $stmt->bindParam(':id_restaurant', $id_product);
            $stmt->execute();
        }
        else if ($function==2) {
            $stmt = $db->prepare('DELETE FROM favourite_restaurants WHERE id_user = :id_user AND id_restaurant = :id_restaurant');
            $stmt->bindParam(':id_user', $id_user);
            $stmt->bindParam(':id_restaurant', $id_product);
            $stmt->execute();
        }   
    }

    else if ($type==2){
        if ($function==1) {
            $stmt = $db->prepare('INSERT INTO favourite_dishes (id_user, id_dish)
                                VALUES (:id_user, :id_dish)');
            $stmt->bindParam(':id_user', $id_user);
            $stmt->bindParam(':id_dish', $id_product);
            $stmt->execute();
        }
        else if ($function==2) {
            $stmt = $db->prepare('DELETE FROM favourite_dishes WHERE id_user = :id_user AND id_dish = :id_dish');
            $stmt->bindParam(':id_user', $id_user);
            $stmt->bindParam(':id_dish', $id_product);
            $stmt->execute();
        }   
    }
    
    header('Location: '. $_SERVER['HTTP_REFERER']);
?>