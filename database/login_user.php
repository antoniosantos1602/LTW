<?php
    if (session_status()===PHP_SESSION_NONE) session_start();

    require_once('connection.php');

    $db = getDatabaseConnection();
    // $_SESSION['message'] = "";

    $username = $_POST["username"];
    $pass = sha1($_POST['password']);

    $stmt = $db->prepare('SELECT * FROM users WHERE username=?');
    $stmt->execute([$username]);
    $check = $stmt->fetch();
    if ($check) {
        if ($check['password']==$pass) {
            $_SESSION['id_user'] = $check['id_user'];
            $_SESSION['username'] = $username;
            $_SESSION['user_logged_in'] = true;
            header('Location: ../restaurants.php');
            exit();
        }
        else {
            $_SESSION['message'] = "Password incorreta";
            header('Location: ../login.php');
            exit();
        }
    }
    else {
        $_SESSION['message'] = "Username não encontrado";
        header('Location: ../login.php');
        exit(); 
    }
?>