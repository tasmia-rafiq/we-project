<?php

session_start();
$connect = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connect, "shopping-web");

if (isset($_GET["action"])) {
    if ($_GET["action"] == "delete") {
        foreach ($_SESSION["shopping_cart"] as $keys => $values) {
            if ($values["item_id"] == $_GET["id"]) {
                unset($_SESSION["shopping_cart"][$keys]);
                echo '
                    <script>
                        alert("Item Removed");
                        window.location = "cart.php";
                    </script>
                ';
            }
        }
    }
}

include 'header.php';
?>

<!-- Top Banner Section -->
<section id="shop-header" class="cart-header">
    <h2 class="fadeInDown animate">My Cart</h2>
</section>

<section id="cart" class="section-pad1">
    <?php
    $select_cart = "SELECT * FROM cart";
    $select_cart_result = mysqli_query($connect, $select_cart) or die(mysqli_error($connect));
    $grand_total = 0;

    if (mysqli_num_rows($select_cart_result) > 0) { ?>
        <table width="100%">
            <thead>
                <tr>
                    <td>Remove</td>
                    <td>Image</td>
                    <td>Product</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Subtotal</td>
                </tr>
            </thead>

            <?php
            while ($cart_rows = mysqli_fetch_assoc($select_cart_result)) { ?>
                <tbody>
                    <tr>
                        <td><a href="action.php?remove=<?php echo $cart_rows["cart_id"]; ?>" onClick="return confirm('Are you sure you want to remove this item?');"><i class="far fa-times-circle"></i></a></td>

                        <td><img src="<?php echo $cart_rows["product_img"] ?>" alt=""></td>
                        <td><?php echo $cart_rows["product_title"] ?></td>
                        <td>Rs. <?php echo $cart_rows["product_price"] ?></td>
                        <td>
                            <input class="form-control itemQty" type="number" value="<?php echo $cart_rows["quantity"] ?>" />
                        </td>
                        <td>Rs.<?php echo $cart_rows["total_price"]; ?></td>

                        <input type="hidden" class="pid" value="<?php echo $cart_rows["cart_id"]; ?>" />
                        <input type="hidden" class="pprice" value="<?php echo $cart_rows["product_price"]; ?>" />

                        <?php $grand_total += $cart_rows["total_price"]; ?>
                    </tr>
                </tbody>
            <?php
            } ?>
            <tr>
                <td>
                    <a href="action.php?clear=all" onClick="return confirm('Are you sure to clear your cart?');"><button class="white">Empty Cart</button></a>
                </td>
            </tr>
        </table>
    <?php
    } else { ?>
        <div class="empty-result">
            <h3>You Cart is empty!</h3>
        </div>
    <?php
    } ?>


    <!-- <?php
            if (isset($_COOKIE['user_cart'])) {
                $pid = json_decode($_COOKIE['user_cart']);
                if (is_object($pid)) {
                    $pid = get_object_vars($pid);
                }
                $pids = implode(',', $pid);

                $cartQuery = "SELECT * FROM products WHERE product_id IN ({$pids})";
                $cart = mysqli_query($connect, $cartQuery) or die(mysqli_error($connect));
                if (mysqli_num_rows($cart) > 0) { ?>
                    <table width="100%">
                        <thead>
                            <tr>
                                <td>Remove</td>
                                <td>Image</td>
                                <td>Product</td>
                                <td>Price</td>
                                <td>Quantity</td>
                                <td>Subtotal</td>
                            </tr>
                        </thead>
                        <?php
                        foreach ($cart as $cart_rows) { ?>
                            <tbody>
                                <tr>
                                    <td><a href="" class="remove-cart-item" data-id="<?php echo $cart_rows['product_id']; ?>"><i class="far fa-times-circle"></i></a></td>
                                    <td><img src="<?php echo $cart_rows["product_img"] ?>" alt=""></td>
                                    <td><?php echo $cart_rows["product_title"] ?></td>
                                    <td>$<?php echo $cart_rows["product_price"] ?></td>
                                    <td>
                                        <input class="form-control item-qty" type="number" value="1"/>
                                        <input type="hidden" class="item-id" value="<?php echo $cart_rows['product_id']; ?>"/>
                                        <input type="hidden" class="item-price" value="<?php echo $cart_rows['product_price']; ?>"/>
                                    </td>
                                    <!-- <td><input type="number" value="1" name="quantity"></td> -->
    <td>$<span class="sub-total"><?php echo $cart_rows['product_price']; ?></span></td>
    </tr>
    </tbody>

<?php
                        } ?>
</table>
<?php
                }
            } else {
?>
<div class="empty-result">
    <h3>You Cart is empty!</h3>
</div>
<?php
            } ?> -->

</section>

<!-- Coupen Section -->
<section id="cart-add" class="section-pad1">
    <!-- <div id="coupon">
            <h3>Apply Coupon</h3>
            <div>
                <input type="text" placeholder="Enter Your Coupon">
                <button class="normal">Apply</button>
            </div>
        </div> -->

    <div id="subtotal">
        <h3>Cart Totals</h3>
        <table>
            <tr>
                <td>Cart Subtotal</td>
                <td>Rs. <?php echo number_format($grand_total, 2); ?></td>
                <!-- <td>$ <span class="total-amount"></span></td> -->
            </tr>

            <tr>
                <td>Shipping</td>
                <td>Free</td>
            </tr>

            <tr>
                <td><strong>Total</strong></td>
                <td>Rs. <?php echo number_format($grand_total, 2); ?></td>
                <!-- <td><strong>$ </strong><strong class="total-amount"></strong></td> -->
            </tr>
        </table>

        <button class="normal"><a href="checkout.php" style="text-decoration:none; color: #fff;">Proceed to Checkout</a></button>
    </div>
</section>

<?php include 'footer.php'; ?>