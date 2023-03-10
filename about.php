<?php
    if (session_status()===PHP_SESSION_NONE) session_start();

    require_once('templates/common.php');
    
    output_header();
    output_sidebar();
    output_page_name('Sobre', 0, 0);
    output_about();
    output_footer();
?>