<?php
    if (session_status()===PHP_SESSION_NONE) session_start();
    
    require_once('connection.php');

    $db = getDatabaseConnection();

    $user = $_POST["usertype"];
    // $_SESSION['message'] = "";

    $username = $_POST["username"];
    $stmt = $db->prepare('SELECT * FROM users WHERE username=?');
    $stmt->execute([$username]);
    $check = $stmt->fetch();
    if ($check) {
        $_SESSION['message'] = "Username já existe";
        header('Location: ../register.php');
        exit();
    }

    $email = $_POST["email"];
    $stmt = $db->prepare('SELECT * FROM users WHERE email=?');
    $stmt->execute([$email]);
    $check = $stmt->fetch();
    if ($check) {
        $_SESSION['message'] = "Email já existe";
        header('Location: ../register.php');
        exit();
    }

    $pass = sha1($_POST["password"]);    // Funções hash -> md5 < sha1 < hash
    $add = $_POST["address"];
    $phone = $_POST["phone"];
    // $photo = $_POST["photo"];
    $nif = $_POST["nif"];
    $regist = $_POST["registration"];

    $stmt = $db->prepare('INSERT INTO users (username, password, email, address, phone, nif)
                            VALUES (:username, :password, :email, :address, :phone, :nif)');
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $pass);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':address', $add);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':nif', $nif);
    $stmt->execute();

    $last_id = $db->lastInsertId();
    $stmt = $db->prepare('INSERT INTO customers(id_user) 
                            VALUES (:id_user)');
    $stmt->bindParam(':id_user', $last_id);
    $stmt->execute();
    
    if ($user=='owner') {
        $stmt = $db->prepare('INSERT INTO owners(id_user) 
                                VALUES (:id_user)');
        $stmt->bindParam(':id_user', $last_id);
        $stmt->execute();
    }
    else if ($user=='driver') {
        $stmt = $db->prepare('INSERT INTO drivers(id_user, registration) 
                                VALUES (:id_user, :registration)');
        $stmt->bindParam(':id_user', $last_id);
        $stmt->bindParam(':registration', $regist);
        $stmt->execute();
    }

    $_SESSION['id_user'] = $last_id;
    $_SESSION['username'] = $username;
    $_SESSION['user_logged_in'] = true;

    if ($user=='owner') header('Location: ../register_restaurant.php');
    else header('Location: ../index.php');
    exit;
?>