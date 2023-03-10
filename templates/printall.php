<?php function output_restaurants() { 
    $db = new PDO('sqlite:database/take_away.db');
    $stmt = $db->prepare('SELECT * FROM restaurants');
    $stmt->execute();
    $restaurants = $stmt->fetchAll(); ?>

    <div id="restaurants">
        <?php foreach( $restaurants as $restaurant) { ?>
        <article>
            <header>
                <h1><a href="restaurant.php?id=<?php echo $restaurant['id_restaurant'] ?>">
                    <?php echo $restaurant['name'] ?>
                </a></h1>
            </header>
            <img src="<?php echo $restaurant['photo'] ?>" alt="Restaurant Image">
            <p><i class="fa fa-map-marker" aria-hidden="true"></i>
                <?php echo $restaurant['address'] ?>
            </p>
            <span class="category"><?php echo $restaurant['category'] ?></span>
        </article>
        <?php } ?>  
    </div>
<?php } ?>


<?php function output_descrestaurant($restaurant, $dishes, $reviews) {
    require_once('common.php');
    $_SESSION['id_restaurant'] = $restaurant['id_restaurant'] ?>
    <div id="restaurant">
    <article>
        <!-- <img src="https://picsum.photos/600/300?business" alt=""> -->
        <img src="<?php echo $restaurant['photo'] ?>" alt="Restaurant Image">
        <p> <?php echo $restaurant['info'] ?></p> 
        <p><i class="fa fa-map-marker" aria-hidden="true"></i>
            <?php echo $restaurant['address'] ?>
        </p>
        <span class="category"><?php echo $restaurant['category'] ?></span>

        <?php if (isset($_SESSION['id_user']) && $_SESSION['id_user']==$restaurant['id_owner']) :?>
            <br><input id="edit_rest" type="button" onclick="location.href='edit_restaurant.php';" value="Editar restaurante" />
            <br><input id="edit_rest" type="button" onclick="location.href='orders_rest.php';" value="Ver encomendas" />
        <?php endif ?>

        <h3><i class="fa fa-cutlery" aria-hidden="true"></i> Pratos</h3>
        <?php if (isset($_SESSION['id_user']) && $_SESSION['id_user']==$restaurant['id_owner']) : ?>
            <input id="add_dish" type="button" onclick="location.href='create_dish.php';" value="Adicionar prato" />
        <?php endif ?>

        <section id="products">
        <?php foreach($dishes as $dish) { ?>
            <article>
                <h2><?php echo $dish['name']?></h2>
                <img src="<?php echo $dish['photo'] ?>" width="150px" height="150px" alt="Dish Image">
                <p class="price"><?php echo $dish['price'] . " €"?></p>
                <?php if (isset($_SESSION['user_logged_in'])) :?>
                    <form action="database/add_cart.php" method="POST">
                        <input name="id" type="hidden" value="<?php echo $dish['id_dish'] ?>">
                        <input name="id_restaurant" type="hidden" value="<?php echo $dish['id_restaurant'] ?>">
                        <input name="name" type="hidden" value="<?php echo $dish['name'] ?>">
                        <input name="price" type="hidden" value="<?php echo $dish['price'] ?>">
                        <input name="quantity" class="quantity" type="number" min="1" value="1">
                        <button type="submit"><i class="fa fa-cart-plus" aria-hidden="true"></i></button>
                        <?php $db = new PDO('sqlite:database/take_away.db');
                        $stmt = $db->prepare('SELECT * FROM favourite_dishes WHERE id_user = :id_user AND id_dish = :id_dish');
                        $stmt->bindParam(':id_user', $_SESSION['id_user']);
                        $stmt->bindParam(':id_dish', $dish['id']);
                        $stmt->execute();
                        $fav_dish = $stmt->fetch(); 
                        if ($fav_dish==null) : ?>
                            <i class="fa fa-heart-o" aria-hidden="true" onclick="change_fav(this, <?php echo $_SESSION['id_user'] . ',' . $dish['id_dish'] . ',' . '2' ?>)"></i>
                        <?php else : ?>
                            <i class="fa fa-heart" aria-hidden="true" onclick="change_fav(this, <?php echo $_SESSION['id_user'] . ',' . $dish['id_dish'] . ',' . '2' ?>)"></i>
                        <?php endif ?>
                        <?php if (isset($_SESSION['id_user']) && $_SESSION['id_user']==$restaurant['id_owner']) :?>
                            <i class="fa fa-pencil" aria-hidden="true" onclick="location.href='edit_dish.php?id=<?php echo $dish['id_dish'] ?>';"></i>
                            <i class="fa fa-trash" aria-hidden="true" onclick="open_modal(<?php echo $dish['id_dish'] . ',' . 0 . ', \'' . $dish['name'] . '\',' . 0 ?> )"></i>
                        <?php endif ?>
                    </form>
                <?php endif ?>
            </article>
        <?php } ?>
        </section>

        <?php output_modal(); ?>

        <section id="reviews">
            <h3><i class="fa fa-comment" aria-hidden="true"></i> Comentários</h3>
            <?php foreach ($reviews as $review) { ?>
                <article class="comment">
                <span class="user"><?php echo $review['username'] ?></span>
                <span class="date"><?php echo $review['published'] ?></span>
                <span class="score"><?php echo $review['score'] ?><i class="fa fa-star" aria-hidden="true"></i></span>
                <p><?php echo $review['texto']?></p>
                </article>
            <?php } ?>
            <?php if (isset($_SESSION['user_logged_in']) && $_SESSION['id_user']!=$restaurant['id_owner']) :
                $_SESSION['id_rest'] = $restaurant['id_restaurant']; ?> 
                <form action="database/create_review.php" method="POST">
                    <h2>Deixa a tua opinião...</h2>
                    <textarea name="comment" required></textarea>
                    <label> <b>Avaliação:</b> 
                    <input type="number" name="score" min="1" max="5" required> <i class="fa fa-star" aria-hidden="true"></i><br>
                    </label>
                    <button type="submit">Publicar</button>
                </form>
            <?php endif ?>
        </section>
      </article>
</div>
<?php } ?>

<?php function output_user($user) { ?>
    <div id="user">
    <article>
        <!-- <img src="https://picsum.photos/600/300?business" alt=""> -->
        <img src="<?php echo $user['photo'] ?>" alt="User Photo">
        
        <p>
            <i class="fa fa-envelope" aria-hidden="true"></i>
            <b>Email:</b>
            <span class="email"> <?php echo $user['email'] ?> </span>
        </p>
        <p>
            <i class="fa fa-home" aria-hidden="true"></i>
            <b>Morada:</b>
            <span class="address"> <?php echo $user['address'] ?></span>
        </p>
        <p>
            <i class="fa fa-phone" aria-hidden="true"></i>
            <b>Telemovel:</b>
            <span class="phone"> <?php echo $user['phone'] ?></span>
        </p>
        <p>
            <i class="fa fa-id-card-o" aria-hidden="true"></i>
            <b>NIF:</b>
            <span class="nif"> <?php echo $user['nif'] ?></span>
        </p>
        <?php if (isset($_SESSION['id_user']) && $_SESSION['id_user']==$_GET['id']) :?>
            <button onclick="location.href='/edit_user.php';"><i class="fa fa-user" aria-hidden="true"></i> Editar Perfil</button>
            <button onclick="location.href='/orders.php';"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Minhas Encomendas</button>
        <?php endif ?>
    </article>

    <h3><i class="fa fa-home" aria-hidden="true"></i> Restaurantes Favoritos</h3>
    <section id="fav_rest">
    <?php $db = new PDO('sqlite:database/take_away.db');
        $stmt = $db->prepare('SELECT * FROM favourite_restaurants fr INNER JOIN restaurants r ON fr.id_restaurant=r.id_restaurant WHERE fr.id_user = :id_user');
        $stmt->bindParam(':id_user', $_GET['id']);
        $stmt->execute();
        $fav_rest = $stmt->fetchAll(); 
        
        foreach($fav_rest as $fr) { ?>
            <article>
                <a href="restaurant.php?id=<?php echo $fr['id_restaurant'] ?>"><?php echo $fr['name'] ?></a>
            </article>
        <?php } ?>
    </section>

    <h3><i class="fa fa-cutlery" aria-hidden="true"></i> Pratos Favoritos</h3>
    <section id="fav_dish">
    <?php $db = new PDO('sqlite:database/take_away.db');
        $stmt = $db->prepare('SELECT * FROM favourite_dishes fd INNER JOIN dishes d ON fd.id_dish=d.id_dish WHERE fd.id_user = :id_user');
        $stmt->bindParam(':id_user', $_GET['id']);
        $stmt->execute();
        $fav_rest = $stmt->fetchAll(); 
        
        foreach($fav_rest as $fr) { ?>
            <article>
                <a href="restaurant.php?id=<?php echo $fr['id_restaurant'] ?>"><?php echo $fr['name'] ?></a>
            </article>
        <?php } ?>
    </section>
    </div>
    
<?php } ?>


<?php function output_orders() { 
    require_once('database/connection.php') ?> 
    <div id="orders">
        <?php $orders = getOrders($_SESSION ['id_user']); 
        foreach($orders as $order) { ?>
            <article id="order">
                <h3><?php echo $order['rName'] ?></h3>
                <?php $dishes = getDishes_order($order ['id_order']); 
                $driver = getDriver($order['id_driver']); 
                foreach($dishes as $dish) { ?>
                    <p>- <?php echo $dish['n_dish'] . 'x ' . $dish['dName'] ?></p>
                <?php } ?>
                
                <?php if ($driver!=null) : ?><p><i class="fa fa-motorcycle" aria-hidden="true"></i> <?php echo $driver['uName'] . ' | ' . $driver['dRegist'] ?></p><?php endif ?>
                <?php if ($order['state']=='Received') : ?>
                    <p> <i class="fa fa-spinner" aria-hidden="true"></i> Received</p><?php endif ?>
                <?php if ($order['state']=='Preparing') : ?>
                    <p> <i class="fa fa-hourglass-end" aria-hidden="true"></i> Preparing</p><?php endif ?>
                <?php if ($order['state']=='Ready') : ?>
                    <p> <i class="fa fa-paper-plane" aria-hidden="true"></i> Ready</p><?php endif ?>
                <?php if ($order['state']=='Delivered') : ?>
                    <p> <i class="fa fa-check" aria-hidden="true"></i> Delivered</p><?php endif ?>

                <p id="price"><i class="fa fa-money" aria-hidden="true"></i> <?php echo $order['total'] ?>€</p>
            </article>
        <?php } ?>
    </div>
<?php } ?>

<?php function output_rest_orders() {
    require_once('database/connection.php') ?> 
    <div id="orders">
        <?php $orders = getRestOrders($_SESSION ['id_restaurant']); 
        foreach($orders as $order) { ?>
            <article id="order">
                <h3><?php echo $order['uName'] ?></h3>
                <?php $dishes = getDishes_order($order ['id_order']); 
                $driver = getDriver($order['id_driver']); 
                foreach($dishes as $dish) { ?>
                    <p>- <?php echo $dish['n_dish'] . 'x ' . $dish['dName'] ?></p>
                <?php } ?>

                <?php if ($driver!=null) : ?> <p><i class="fa fa-motorcycle" aria-hidden="true"></i> <?php echo $driver['uName'] . ' | ' . $driver['dRegist'] ?></p>
                <?php else : ?> <p><i class="fa fa-motorcycle" aria-hidden="true"></i> ---</p> <?php endif ?>
                <form action="/database/change_order_state.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $order['id_order'] ?>">
                    <select name="state">
                        <option value="Received" <?php if ($order['state']=='Received') : ?> selected <?php endif ?>>Received</option>
                        <option value="Preparing" <?php if ($order['state']=='Preparing') : ?> selected <?php endif ?>>Preparing</option>
                        <option value="Ready" <?php if ($order['state']=='Ready') : ?> selected <?php endif ?>>Ready</option>
                        <option value="Delivered" <?php if ($order['state']=='Delivered') : ?> selected <?php endif ?>>Delivered</option>
                    </select>

                    <br><button type="submit" id="alter-btn">Alterar</button>
                </form>
 
                <p id="price"><i class="fa fa-money" aria-hidden="true"></i> <?php echo $order['total'] ?>€</p>
             </article>
         <?php } ?>
     </div>
<?php } ?> 