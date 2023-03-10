<?php function output_login_forum() { ?>
    <form id="login" action="database/login_user.php" method="POST">
        <p id="error_msg"><?php if (isset($_SESSION['message'])) : echo $_SESSION['message']; unset($_SESSION['message']); endif ?></p>
        <label>
            Nome de utilizador <br><input type="text" name="username" required>
        </label><br>
        <label>
            Palavra passe <br><input type="password" name="password" required>
        </label><br>
        <button type="submit">Iniciar Sessão</button>
        <p>Ainda não tem conta? <a href="register.php">Registe-se já</a></p>
    </form>
<?php } ?>


<?php function output_register_forum() { ?>
    <form id="register" action="database/register_user.php" method="POST">
        <p id="error_msg"><?php if (isset($_SESSION['message'])) : echo $_SESSION['message']; unset($_SESSION['message']); endif ?></p>
        <label>Tipo de conta</label><br>
        <select id="usertype" name="usertype" aria-label="usertype">
            <option value="null">---</option>
            <option value="customer">Cliente</option>
            <option value="owner">Dono de Restaurante</option>
            <option value="driver">Estafeta</option>
        </select><br>
        <label>Nome de utilizador
            <br><input type="text" name="username" required>
        </label><br>
        <label>Email
            <br><input type="email" name="email" required>
        </label><br>
        <label>Palavra passe
            <br><input type="password" name="password" required>
        </label><br>
        <label>Morada
            <br><input type="text" name="address">
        </label><br>
        <label>Telemóvel
            <br><input type="number" name="phone">
        </label><br>
        <label>Foto
            <br><input type="image" name="photo">
        </label><br>
        <label>NIF
            <br><input type="number" name="nif">
        </label><br>
        <label>Matrícula
            <br><input type="text" name="registration" placeholder="12-AB-34" pattern="[0-9]{2}-[A-Z]{2}-[0-9]{2}" required>
        </label><br>
        <button id="create-btn" type="submit">Criar conta</button>
    </form>
<?php } ?>


<?php function output_register_restaurant_forum() { ?>
    <form id="register" action="database/register_restaurant.php" method="POST">
        <p id="error_msg"><?php if (isset($_SESSION['message'])) : echo $_SESSION['message']; unset($_SESSION['message']); endif ?></p>
        <label>Categoria</label><br>
        <select id="resttype" name="resttype" aria-label="resttype">
            <option value="null">---</option>
            <option value="Asiática">Asiática</option>
            <option value="Churrasqueira">Churrasqueira</option>
            <option value="Fast food">Fast food</option>
            <option value="Gourmet">Gourmet</option>
            <option value="Pastelaria">Pastelaria</option>
            <option value="Snacks">Snacks</option>
            <option value="Vegetariano">Vegetariano</option>
        </select><br>
        <label>Nome do Restaurante
            <br><input type="text" name="name" required>
        </label><br>
        <label>Morada
            <br><input type="text" name="address" required>
        </label><br>
        <label>Informação
            <br><textarea name="info"></textarea>
        </label><br>
        <label>Foto
            <br><input type="image" name="photo">
        </label><br>
        <button id="create-btn" type="submit">Criar restaurante</button>
    </form>
<?php } ?>

<?php function output_dish_forum() { ?>
    <form id="login" action="database/register_dish.php" method="POST">
        <p id="error_msg"><?php if (isset($_SESSION['message'])) : echo $_SESSION['message']; unset($_SESSION['message']); endif ?></p>
        <label>Nome
            <br><input type="text" name="name" required>
        </label><br>
        <label>Preço
            <br><input type="number" name="price" step="0.01" required>
        </label><br>
        <label>Foto
            <br><input type="image" name="photo">
        </label><br>
        <button id="create-btn" type="submit">Adicionar prato</button>
    </form>
<?php } ?>

<?php function output_edit_user_forum($user) { ?>
    <form id="login" action="database/change_db.php" method="POST">
        <p id="error_msg"><?php if (isset($_SESSION['message'])) : echo $_SESSION['message']; unset($_SESSION['message']); endif ?></p>
        <input type="hidden" name="type" value="1">
        <label>Nome de utilizador
            <br><input type="text" name="username" value="<?php echo $user['username'] ?>" required>
        </label><br>
        <label>Email
            <br><input type="email" name="email" value="<?php echo $user['email'] ?>" required>
        </label><br>
        <label>Palavra passe
            <br><input type="password" name="password" value="<?php echo $user['password'] ?>" required>
        </label><br>
        <label>Morada
            <br><input type="text" name="address" value="<?php echo $user['address'] ?>">
        </label><br>
        <label>Telemóvel
            <br><input type="number" name="phone" value="<?php echo $user['phone'] ?>">
        </label><br>
        <!-- <label>Foto
            <br><input type="image" name="photo" value="<?php echo $user['photo'] ?>">
        </label><br> -->
        <label>NIF
            <br><input type="number" name="nif" value="<?php echo $user['nif'] ?>">
        </label><br>
        <button id="create-btn" type="submit">Editar conta</button>
    </form>
<?php } ?>

<?php function output_edit_restaurant_forum($rest) { ?>
    <form id="login" action="database/change_db.php" method="POST">
        <p id="error_msg"><?php if (isset($_SESSION['message'])) : echo $_SESSION['message']; unset($_SESSION['message']); endif ?></p>
        <input type="hidden" name="type" value="2">
        <input type="hidden" name="id_rest" value="<?php echo $rest['id_restaurant'] ?>">
        <label>Nome do restaurante
            <br><input type="text" name="name" value="<?php echo $rest['name'] ?>" required>
        </label><br>
        <label>Morada
            <br><input type="text" name="address" value="<?php echo $rest['address'] ?>" required>
        </label><br>
        <label>Informação
            <br><input type="text" name="info" value="<?php echo $rest['info'] ?>">
        </label><br>
        <!-- <label>Categoria
            <br><input type="text" name="category" value="<?php echo $rest['category'] ?>">
        </label><br> -->
        <!-- <label>Foto
            <br><input type="image" name="photo" value="<?php echo $rest['photo'] ?>">
        </label><br> -->
        <button id="create-btn" type="submit">Editar restaurante</button>
    </form>
<?php } ?>

<?php function output_edit_dish_forum($dish) { ?>
    <form id="login" action="database/change_db.php" method="POST">
        <p id="error_msg"><?php if (isset($_SESSION['message'])) : echo $_SESSION['message']; unset($_SESSION['message']); endif ?></p>
        <input type="hidden" name="type" value="3">
        <input type="hidden" name="id_dish" value="<?php echo $dish['id_dish'] ?>">
        <input type="hidden" name="id_rest" value="<?php echo $dish['id_restaurant'] ?>">
        <label>Nome do prato
            <br><input type="text" name="name" value="<?php echo $dish['name'] ?>" required>
        </label><br>
        <label>Preço
            <br><input type="text" name="price" value="<?php echo $dish['price'] ?>" required>
        </label><br>
        <!-- <label>Foto
            <br><input type="image" name="photo" value="<?php echo $dish['photo'] ?>">
        </label><br> -->
        <button id="create-btn" type="submit">Editar prato</button>
    </form>
<?php } ?>