<?php
    if (session_status()===PHP_SESSION_NONE) session_start();
    
    require_once('connection.php');

    $db = getDatabaseConnection();

    $name = $_POST["name"];
    $stmt = $db->prepare('SELECT * FROM restaurants WHERE name=?');
    $stmt->execute([$name]);
    $check = $stmt->fetch();
    if ($check) {
        $_SESSION['message'] = "Nome já existe";
        header('Location: ../register_restaurant.php');
        exit();
    }

    $add = $_POST["address"];
    $stmt = $db->prepare('SELECT * FROM restaurants WHERE address=?');
    $stmt->execute([$add]);
    $check = $stmt->fetch();
    if ($check) {
        $_SESSION['message'] = "Morada já existe";
        header('Location: ../register_restaurant.php');
        exit();
    }

    $category = $_POST["resttype"];
    $info = $_POST["info"];
    $photo = $_POST["photo"];

    if ($photo==null) {
        $stmt = $db->prepare('INSERT INTO restaurants (id_owner, name, address, info, category)
                            VALUES (:id_owner, :name, :address, :info, :category)');
        $stmt->bindParam(':id_owner', $_SESSION['id_user']);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':address', $add);
        $stmt->bindParam(':info', $info);
        $stmt->bindParam(':category', $category);
        $stmt->execute();
    }

    else {
        $stmt = $db->prepare('INSERT INTO restaurants (id_owner, name, address, info, photo, category)
                            VALUES (:id_owner, :name, :address, :info, :photo, :category)');
        $stmt->bindParam(':id_owner', $_SESSION['id_user']);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':address', $add);
        $stmt->bindParam(':info', $info);
        $stmt->bindParam(':photo', $photo);
        $stmt->bindParam(':category', $category);
        $stmt->execute();
    }

    header('Location: ../restaurants.php');
    exit;

?>