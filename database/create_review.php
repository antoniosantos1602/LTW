<?php 
    if (session_status()===PHP_SESSION_NONE) session_start();

    require_once('connection.php');
    
    $db = getDatabaseConnection();

    $restaurant = $_SESSION['id_rest'];
    $user = $_SESSION['id_user'];
    $score = $_POST['score'];
    $texto = $_POST['comment'];

    $stmt = $db->prepare('INSERT INTO reviews (id_restaurant, id_user, score, texto, published)
                            VALUES (:id_rest, :id_user, :score, :texto, date())');
    $stmt->bindParam(':id_rest', $restaurant);
    $stmt->bindParam(':id_user', $user);
    $stmt->bindParam(':score', $score);
    $stmt->bindParam(':texto', $texto);
    $stmt->execute();

    header('Location: '. $_SERVER['HTTP_REFERER'] . "#reviews");
    exit;
?>