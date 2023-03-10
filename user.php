<?php
    if (session_status()===PHP_SESSION_NONE) session_start();

    require_once('templates/common.php');
    require_once('templates/printall.php');
    require_once('database/connection.php');

    $user = getUser($_GET['id']);
  
    output_header();
    output_sidebar();
    output_page_name($user['username'], 0, 0);
    output_user($user);
    output_footer();
?>