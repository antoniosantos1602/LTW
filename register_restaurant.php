<?php
    if (session_status()===PHP_SESSION_NONE) session_start();

    require_once('templates/common.php');
    require_once('templates/account.php');
    
    output_header();
    output_sidebar();
    output_page_name('Criar restaurante', 0, 0);
    output_register_restaurant_forum();
    output_footer();
?>