<?php
    if (session_status()===PHP_SESSION_NONE) session_start();

    require_once('templates/common.php');
    require_once('templates/printall.php');
    
    output_header();
    output_sidebar();
    output_page_name('Minhas Encomendas', 0,0);
    output_orders();
    output_footer();
?>