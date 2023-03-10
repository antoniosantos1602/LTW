<?php
    if (session_status()===PHP_SESSION_NONE) session_start();

    require_once('templates/common.php');
    require_once('templates/account.php');

    output_header();
    output_sidebar();
    output_page_name('Criar conta', 0, 0);
    output_register_forum();
    output_footer();
    // var_dump($_SESSION);
?>