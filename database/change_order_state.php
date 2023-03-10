<?php
    if (session_status()===PHP_SESSION_NONE) session_start();

    require_once('connection.php');

    $db = getDatabaseConnection();

    if ($_POST['state'] === "Ready") {

        $stmt = $db->prepare('SELECT id_driver FROM orders WHERE id_order = :id');
        $stmt->bindParam(':id', $_POST['id']);
        $stmt->execute();
        $order = $stmt->fetch();
        
        if ($order['id_driver'] == NULL) { 
            $stmt = $db->prepare('SELECT id_user FROM drivers ORDER BY RANDOM() LIMIT 1');
            $stmt->execute();
            $driver = $stmt->fetch();
            $id_driver = (int)$driver['id_user'];
    
            $stmt = $db->prepare('UPDATE orders SET id_driver = :id_driver, state = :state WHERE id_order = :id');
            $stmt->bindParam(':id_driver', $id_driver);
            $stmt->bindParam(':state', $_POST['state']);
            $stmt->bindParam(':id', $_POST['id']);
            $stmt->execute();
        }
    }

    else {
        $stmt = $db->prepare('UPDATE orders SET state = :state WHERE id_order = :id');
        $stmt->bindParam(':state', $_POST['state']);
        $stmt->bindParam(':id', $_POST['id']);
        $stmt->execute();
    }

    

    header('Location: '. $_SERVER['HTTP_REFERER']);
    exit;
?>