<?php
    if (session_status()===PHP_SESSION_NONE) session_start();

    require_once('templates/common.php');
    require_once('templates/account.php');
    
    output_header();
    output_sidebar();
    output_page_name('Iniciar Sessão', 0,0);
    output_login_forum();
    output_footer();
?>