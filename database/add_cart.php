<?php
    if (session_status()===PHP_SESSION_NONE) session_start();
    
    $product_id = (int)$_POST['id'];
    $name = $_POST['name'];
    $quantity = (int)$_POST['quantity'];
    $price = (float)$_POST['price'];
    $restaurant_id = (int)$_POST ['id_restaurant'];
    
    if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        if (array_key_exists($product_id, $_SESSION['cart'])) 
            $_SESSION['cart'][$product_id][1] += $quantity;
        else {
            $_SESSION['cart'][$product_id][0] = $name;
            $_SESSION['cart'][$product_id][1] = $quantity;
            $_SESSION['cart'][$product_id][2] = $price;
            $_SESSION['cart'][$product_id][3] = $restaurant_id;
            if (!in_array($restaurant_id, $_SESSION['cart_id_rest']))
                array_push($_SESSION['cart_id_rest'], $restaurant_id);
        }
    }
    else {
        $_SESSION['cart'] = array($product_id => array($name, $quantity, $price, $restaurant_id));
        $_SESSION['cart_id_rest'] = array($restaurant_id);
    }

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
?>