<?php function output_cart(){ 
    require_once('common.php');
    $_SESSION['subtotal'] = 0.00; ?>
    <section id="cart">
        <p id="error_msg"><?php if (isset($_SESSION['message'])) : echo $_SESSION['message']; unset($_SESSION['message']); endif ?></p>
        <table>
            <thead>
                <tr><th>Produto</th><th>Quantidade</th><th>Preço</th><th>Total</th><th>Remover</th></tr>
            </thead>
            <?php if (isset($_SESSION['cart'])) { 
                foreach($_SESSION['cart'] as $product_id=>$product) { ?>
                    <tr>
                        <td><?php echo $product[0] ?></td>
                        <td><?php echo $product[1] ?></td>
                        <td><?php echo $product[2] ?></td>
                        <td><?php echo $product[1]*$product[2] ?></td>
                        <td> <a onclick="open_modal(<?php echo $product_id . ',' . $product[3] . ', \'' . $product[0] . '\',' . 1 ?> )">X</a> </td>
                    </tr>
                <?php $_SESSION['subtotal'] += $product[1]*$product[2]; }
            } ?>
            <tfoot>
                <tr><th colspan="4">Total:</th><th><?php echo $_SESSION['subtotal'] ?></th></tr>
            </tfoot>
        </table>
        <?php if (isset($_SESSION['cart']) && sizeof($_SESSION['cart']) > 0) { ?>
            <a id="cart_order" href="/database/make_order.php"> Encomendar <i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
        <?php } 
        
        output_modal(); ?>

    </section>
<?php } ?>
                        
