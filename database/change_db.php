<?php
    if (session_status()===PHP_SESSION_NONE) session_start();

    require_once('connection.php');

    $db = getDatabaseConnection();
    $type = $_POST['type'];
    
      ////////////////////
     // EDIR USER INFO //
    ////////////////////
    if ($type==1) {
        $stmt = $db->prepare('SELECT * FROM users WHERE id_user = :id');
        $stmt->bindParam(':id', $_SESSION['id_user']);
        $stmt->execute();
        $old_user = $stmt->fetch();

        $username = $_POST['username'];
        $email = $_POST['email'];
        $pass = $_POST["password"];

        // check if new username doesn't already exists
        if ($username != $old_user['username']) {
            $stmt = $db->prepare('SELECT * FROM users where username = :username');
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $check = $stmt->fetch();
            if ($check) {
                $_SESSION['message'] = "Username já existe";
                header('Location: '. $_SERVER['HTTP_REFERER']);
                exit;
            }
        }

        // check if new email doesn't already exists
        if ($email != $old_user['email']) { 
            $stmt = $db->prepare('SELECT * FROM users where email = :email');
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $check = $stmt->fetch();
            if ($check) {
                $_SESSION['message'] = "Email já existe";
                header('Location: '. $_SERVER['HTTP_REFERER']);
                exit();
            }
        }

        if ($pass != $old_user['password']) $pass_sha = sha1($pass);
        else $pass_sha = $pass;

        $stmt = $db->prepare('UPDATE users SET username = :username, password = :pass, email = :email, address = :add, phone = :phone, nif = :nif WHERE id_user = :id');
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':pass', $pass_sha);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':add', $_POST['address']);
        $stmt->bindParam(':phone', $_POST['phone']);
        $stmt->bindParam(':nif', $_POST['nif']);
        $stmt->bindParam(':id', $_SESSION['id_user']);
        $stmt->execute();

        $_SESSION['username'] = $username;
        header('Location: /user.php?id=' . $_SESSION['id_user']);
        exit;
    }

      //////////////////////////
     // EDIR RESTAURANT INFO //
    //////////////////////////
    else if ($type==2) {
        $stmt = $db->prepare('SELECT * FROM restaurants WHERE id_restaurant = :id');
        $stmt->bindParam(':id', $_POST['id_rest']);
        $stmt->execute();
        $old_rest = $stmt->fetch();

        $name = $_POST['name'];
        $add = $_POST['address'];

        // check if new restaurant's name doesn't already exists
        if ($name != $old_rest['name']) {
            $stmt = $db->prepare('SELECT * FROM restaurants where name = :name');
            $stmt->bindParam(':name', $name);
            $stmt->execute();
            $check = $stmt->fetch();
            if ($check) {
                $_SESSION['message'] = "Nome de restaurante já existe";
                header('Location: '. $_SERVER['HTTP_REFERER']);
                exit;
            }
        }

        // check if new restaurant's address doesn't already exists
        if ($add != $old_rest['address']) {
            $stmt = $db->prepare('SELECT * FROM restaurants where address = :add');
            $stmt->bindParam(':add', $add);
            $stmt->execute();
            $check = $stmt->fetch();
            if ($check) {
                $_SESSION['message'] = "Morada do restaurante já existe";
                header('Location: '. $_SERVER['HTTP_REFERER']);
                exit;
            }
        }

        $stmt = $db->prepare('UPDATE restaurants SET name = :name, address = :add, info = :info WHERE id_restaurant = :id');
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':add', $add);
        $stmt->bindParam(':info', $_POST['info']);
        $stmt->bindParam(':id', $_POST['id_rest']);
        $stmt->execute();
        header('Location: /restaurant.php?id=' . $_POST['id_rest']);
        exit;
    }

      ////////////////////
     // EDIR DISH INFO //
    ////////////////////
    else if ($type==3) {
        $stmt = $db->prepare('UPDATE dishes SET name = :name, price = :price WHERE id_dish = :id');
        $stmt->bindParam(':name', $_POST['name']);
        $stmt->bindParam(':price', $_POST['price']);
        $stmt->bindParam(':id', $_POST['id_dish']);
        $stmt->execute();
        header('Location: /restaurant.php?id=' . $_POST['id_rest']);
        exit;
    }
?>