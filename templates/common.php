<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Take Away</title>    
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/style.css" rel="stylesheet">
        <link href="css/layout.css" rel="stylesheet">
        <script src="js/script.js" defer></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>


<?php function output_header() { ?>
    <header>
        <a href="index.php"><img src="images/logo.png" alt="Take Away"></a>
    </header>
    <nav id="navbar">
        <div id="search_bar">
            <input type="search" placeholder="Pesquisa">
            <i class="fa fa-search" aria-hidden="true"></i>
        </div>
        <?php if (isset($_SESSION['user_logged_in'])) :?>
            <div id="logedin">
                <a id="cart_icon" href="cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a> 
                <a id="user_icon" href="user.php?id=<?php echo $_SESSION['id_user']?>"><i class="fa fa-user" aria-hidden="true"></i> <?php echo $_SESSION['username'] ?></a>
                <a id="logout" href="logout.php"> Terminar Sessão <i class="fa fa-sign-out" aria-hidden="true"></i></a>
            </div>
            
        <?php else : ?>
            <div id="signup">
                <a href="login.php">Iniciar Sessão</a>
            </div>
        <?php endif ?>

    </nav>
<?php } ?>

<?php function output_sidebar() { ?>
    <div id="sidebar">
        <h2><a href="index.php">Início</a></h2>
        <h2><a href="restaurants.php">Restaurantes</a></h2>
        <h2><a href="about.php">Sobre</a></h2>
    </div>
<?php } ?>

<?php function output_background() { ?>
    <div id="background">
        <p>Já sabe o que vai comer hoje?</p>
        <div><a href="restaurants.php">Encomendar</a></div>
    </div>
<?php } ?>

<?php function output_page_name($name, $flag, $id_restaurant) { ?>
    <div id="page_name">
        <h2>
            <?php echo $name;
            if (isset($_SESSION['user_logged_in']) && $flag==1) : 
                $db = new PDO('sqlite:database/take_away.db');
                $stmt = $db->prepare('SELECT * FROM favourite_restaurants WHERE id_user = :id_user AND id_restaurant = :id_rest');
                $stmt->bindParam(':id_user', $_SESSION['id_user']);
                $stmt->bindParam(':id_rest', $id_restaurant);
                $stmt->execute();
                $fav_rest = $stmt->fetch(); 
                if ($fav_rest==null) : ?>
                    <i id="fav_icon" class="fa fa-heart-o" aria-hidden="true" onclick="change_fav(this, <?php echo $_SESSION['id_user'] . ',' . $id_restaurant . ',' . '1' ?>)"></i>
                <?php else : ?>
                    <i id="fav_icon" class="fa fa-heart" aria-hidden="true" onclick="change_fav(this, <?php echo $_SESSION['id_user'] . ',' . $id_restaurant . ',' . '1' ?>)"></i>
                <?php endif ?>
            <?php endif ?>
        </h2>    
    </div>
<?php } ?>

<?php function output_about() { ?>
    <div id="about_text">
        <p>Esta página foi desenvolvida no ambito da cadeira de Linguagens e Tecnologias Web. O nosso objetivo foi criar uma plataforma onde oferecemos uma lista restaurantes com os seus menus para take-away, que permite aos nossos clientes encomendar refeições de uma maneira simples e prática. </p> 
        <h3> Contactos</h3>
        <table>
            <tr><td>Alexandre Afonso</td><td>923445678  <i class="fa fa-phone" aria-hidden="true"></i></td></tr>
            <tr><td>Antonio Santos</td><td>917734896  <i class="fa fa-phone" aria-hidden="true"></i></td></tr>
            <tr><td>Tiago Antunes</td><td>9123678453  <i class="fa fa-phone" aria-hidden="true"></i></td></tr>
            <tr><td>Email</td><td>up201805455@fc.up.pt  <i class="fa fa-envelope" aria-hidden="true"></i></td></tr>
        </table>
    </div>
<?php } ?>

<?php function output_footer() { ?>
    <footer>
        <p>Copyright &copy; FEUP | Desenvolvido por Alexandre Afonso, António Santos e Tiago Antunes</p>
    </footer>
<?php } ?>

<?php function output_modal() { ?>
    <!-- The Modal -->
    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <span class="close" onclick="close_modal()">&times;</span>
            <p id="modal-p"></p>
            <button id="modal-btn" style="padding: 7px;"></button>
        </div>
    </div>
<?php } ?>

    </body>
</html>