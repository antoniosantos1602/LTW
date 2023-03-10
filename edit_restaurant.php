<?php
    if (session_status()===PHP_SESSION_NONE) session_start();

    require_once('database/connection.php');
    require_once('templates/common.php');
    require_once('templates/account.php');
    
    $restaurant = getRestaurant($_SESSION['id_restaurant']);

    output_header();
    output_sidebar();
    output_page_name('Editar Restaurante', 0, 0);
    output_edit_restaurant_forum($restaurant);
    output_footer();
?>