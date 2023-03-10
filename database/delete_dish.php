<?php
    if (session_status()===PHP_SESSION_NONE) session_start();
    
    require_once('connection.php');

    $db = getDatabaseConnection();

    $id_dish = $_POST["id_dish"];

    $stmt = $db->prepare('DELETE FROM dishes WHERE id_dish = :id_dish');
    $stmt->bindParam(':id_dish', $id_dish);
    $stmt->execute();

    header('Location: '. $_SERVER['HTTP_REFERER']);
    exit;
?>