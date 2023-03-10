<?php 
    if (session_status()===PHP_SESSION_NONE) session_start();

    require_once('connection.php');
    $db = getDatabaseConnection();

    if (count($_SESSION['cart_id_rest']) > 1) {
        $_SESSION['message'] =  'A encomenda só pode ser feita com produtos do mesmo restaurante';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    $stmt = $db->prepare('INSERT INTO orders (id_user, id_restaurant, total, state)
                            VALUES (:id_user,:id_restaurant, :total, \'Received\')');
    $stmt->bindParam(':id_user', $_SESSION['id_user']);
    $stmt->bindParam(':id_restaurant', $_SESSION['cart_id_rest'][0]);
    $stmt->bindParam(':total', $_SESSION['subtotal']);
    $stmt->execute();

    $last_id = $db->lastInsertId();

    foreach($_SESSION['cart'] as $product_id=>$product) {
        $stmt = $db->prepare('INSERT INTO dishes_in_orders (id_order, id_dish, n_dish)
                                VALUES (:id_order,:id_dish,:n_dish)');
        $stmt->bindParam(':id_order',$last_id);
        $stmt->bindParam(':id_dish', $product_id); 
        $stmt->bindParam(':n_dish', $product[1]); 
        $stmt->execute();
    }
  
    unset($_SESSION['cart']);
    unset($_SESSION['cart_id_rest']);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
?> 