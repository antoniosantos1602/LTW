<?php
    if (session_status()===PHP_SESSION_NONE) session_start();

    require_once('templates/common.php');
    require_once('templates/printall.php');
    require_once('database/connection.php');

    $restaurant = getRestaurant($_GET['id']);
    $dishes = getDishes($_GET['id']);
    $reviews = getReviews($_GET['id']);
    
    output_header();
    output_sidebar();
    output_page_name($restaurant['name'], 1, $restaurant['id_restaurant']);
    output_descrestaurant($restaurant, $dishes, $reviews);
    output_footer();
?>