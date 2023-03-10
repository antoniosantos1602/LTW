<?php
    if (session_status()===PHP_SESSION_NONE) session_start();

    require_once('database/connection.php');
    require_once('templates/common.php');
    require_once('templates/account.php');
    
    $dish = getDish($_GET['id']);

    output_header();
    output_sidebar();
    output_page_name('Editar Prato', 0, 0);
    output_edit_dish_forum($dish);
    output_footer();
?>