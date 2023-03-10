<?php
    if (session_status()===PHP_SESSION_NONE) session_start();

    require_once('database/connection.php');
    require_once('templates/common.php');
    require_once('templates/account.php');
    
    $user = getUser($_SESSION['id_user']);

    output_header();
    output_sidebar();
    output_page_name('Editar Perfil', 0, 0);
    output_edit_user_forum($user);
    output_footer();
?>