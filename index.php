<?php
    if (session_status()===PHP_SESSION_NONE) session_start();
    
    require_once('templates/common.php');

    output_header();
    output_sidebar();
    output_background();
    output_footer();
?>