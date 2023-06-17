<?php

session_start();
$connect = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connect, "shopping-web");

// if(isset($_POST["add_to_cart"]))
// {
//     if(isset($_SESSION["shopping_cart"]))
//     {
//         $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
//         if(!in_array($_GET["id"], $item_array_id))
//         {
//             $count = count($_SESSION["shopping_cart"]);
//             $item_array = array (
//                 'item_id'   => $_GET["id"],
//                 'item_name'   => $_POST["hidden_name"],
//                 'item_price'   => $_POST["hidden_price"],
//                 'item_img'   => $_POST["hidden_img"],
//                 'item_quantity'   => $_POST["quantity"]
//             );
//             $_SESSION["shopping_cart"][$count] = $item_array;

//         }
//         else
//         {
//             echo '
//                 <script>
//                     alert("Item Already Added");
//                     window.location = "index.php";
//                 </script>
//             ';
//         }
//     }
//     else
//     {
//         $item_array = array (
//             'item_id'   => $_GET["id"],
//             'item_name'   => $_POST["hidden_name"],
//             'item_price'   => $_POST["hidden_price"],
//             'item_img'   => $_POST["hidden_img"],
//             'item_quantity'   => $_POST["quantity"]
//         );
//         $_SESSION["shopping_cart"][0] = $item_array;
//     }
// }

if(isset($_GET["action"]))
{
    if($_GET["action"]=="delete")
    {
        foreach($_SESSION["shopping_cart"] as $keys => $values) 
        {
            if($values["item_id"] == $_GET["id"])
            {
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
    <section id="shop-header" class="about-header">
        <h2>#cart</h2>
        <p>Leave a Message, We love to hear from you!</p>
    </section>

    <section id="cart" class="section-pad1">
        <?php
        if(!empty($_SESSION["shopping_cart"]))
            {?>
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
                $total = 0;
                foreach($_SESSION["shopping_cart"] as $keys => $values)
                {
                ?>  
                    <tbody>
                        <tr>
                            <td><a href="cart.php?action=delete&id=<?php echo $values["item_id"] ?>"><i class="far fa-times-circle"></i></a></td>
                            <td><img src="<?php echo $values["item_img"] ?>" alt=""></td>
                            <td><?php echo $values["item_name"] ?></td>
                            <td>$<?php echo $values["item_price"] ?></td>
                            <td><input type="number" value="<?php echo $values["item_quantity"] ?>"></td>
                            <td>$<?php echo number_format($values["item_price"] * $values["item_quantity"], 2) ?></td>
                        </tr>
                    </tbody>

                    <?php

                        $total = $total + ($values["item_quantity"] * $values["item_price"]);

                }
            }
            else {
                ?>
                <div class="empty-result">
                    <h3>You Cart is empty!</h3>
                </div>
                <?php
            }
            ?>
            
        </table>
    </section>

    <!-- Coupen Section -->
    <section id="cart-add" class="section-pad1">
        <div id="coupon">
            <h3>Apply Coupon</h3>
            <div>
                <input type="text" placeholder="Enter Your Coupon">
                <button class="normal">Apply</button>
            </div>
        </div>

        <div id="subtotal">
            <h3>Cart Totals</h3>
            <table>
                <tr>
                    <td>Cart Subtotal</td>
                    <td>$ <?php echo number_format($total, 2) ?></td>
                </tr>

                <tr>
                    <td>Shipping</td>
                    <td>Free</td>
                </tr>

                <tr>
                    <td><strong>Total</strong></td>
                    <td><strong>$ <?php echo number_format($total, 2) ?></strong></td>
                </tr>
            </table>

            <button class="normal">Proceed to Checkout</button>
        </div>
    </section>

    <!-- Footer -->
    <footer class="section-pad1">
        <div class="col">
            <img class="logo" src="img/logo.png" alt="">
            <h4>Contact</h4>
            <p><strong>Address:</strong> Karachi, Sindh - Pakistan</p>
            <p><strong>Phone:</strong> (021) - 2222567</p>
            <p><strong>Hours:</strong> 09:00 - 18:00, Mon - Sat</p>

            <div class="follow">
                <h4>Follow Us</h4>
                <div class="icon">
                    <i class="fab fa-facebook-f"></i>
                    <i class="fab fa-twitter"></i>
                    <i class="fab fa-instagram"></i>
                    <i class="fab fa-youtube"></i>
                </div>
            </div>
        </div>

        <div class="col">
            <h4>About</h4>
            <a href="#">About Us</a>
            <a href="#">Delivery Information</a>
            <a href="#">Privacy Policy</a>
            <a href="#">Terms & Conditions</a>
            <a href="#">Contact Us</a>
        </div>

        <div class="col">
            <h4>My Account</h4>
            <a href="#">Sign In</a>
            <a href="#">View Cart</a>
            <a href="#">My Wishlist</a>
            <a href="#">Track My Order</a>
            <a href="#">Help</a>
        </div>

        <div class="copyright">
            <p>&copy; 2022, Shopping Website - By Tasmia</p>
        </div>

    </footer>

    <script src="js/index.js"></script>
</body>

</html>