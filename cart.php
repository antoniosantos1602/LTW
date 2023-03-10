<?php
    if (session_status()===PHP_SESSION_NONE) session_start();

    require_once('templates/common.php');
    require_once('templates/carttable.php');
    
    output_header();
    output_sidebar();
    output_page_name('Carrinho de Compras', 0,0);
    output_cart();
    output_footer();
?>