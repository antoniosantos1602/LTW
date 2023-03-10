<?php
    if (session_status()===PHP_SESSION_NONE) session_start();
    unset($_SESSION['cart'][$_POST['id']]);
    if (($key = array_search($_POST['id_rest'], $_SESSION['cart_id_rest'])) !== false)
        unset($_SESSION['cart_id_rest'][$key]);

    header('Location: '. $_SERVER['HTTP_REFERER']);
    exit;
?>