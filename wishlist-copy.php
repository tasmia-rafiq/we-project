<?php
$connect = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connect, "shopping-web");
include 'header.php';
?>

<!-- Top Banner Section -->
    <section id="shop-header" class="about-header">
        <h2>#My_WishList</h2>
        <p>Explore Your Favorites HERE!</p>
    </section>

    <section id="cart" class="section-pad1">       
        <table width="100%">
            <thead>
                <tr>
                    <td>Remove</td>
                    <td>Image</td>
                    <td>Product</td>
                    <td>Price</td>
                </tr>
            </thead>
            <?php
            if(isset($_COOKIE['user_wishlist']) && !empty($_COOKIE['user_wishlist']))
            {
                $pid = array();
                $pid = json_decode($_COOKIE['user_wishlist']);
                if(is_object($pid)){
                    $pid = get_object_vars($pid);
                }
                $pids = implode(',',$pid);
                            
                $wishlistQuery = "SELECT * FROM products WHERE product_id IN ({$pids})";
                $wishlist = mysqli_query($connect, $wishlistQuery);
                    
                    if(mysqli_num_rows($wishlist) > 0)
                    {
                        foreach($wishlist as $wishlist_rows)
                        {   ?>
                            <tbody>
                                <tr>
                                    <td><a href="" class="remove-wishlist-item" data-id="<?php echo $wishlist_rows['product_id']; ?>"><i class="far fa-times-circle"></i></a></td>
                                    <td><img src="<?php echo $wishlist_rows["product_img"] ?>" alt=""></td>
                                    <td><?php echo $wishlist_rows["product_title"] ?></td>
                                    <td>$<?php echo $wishlist_rows["product_price"] ?></td>
                                </tr>
                            </tbody>

                            <?php
                        } ?>
                            
        </table>
                    <?php
                    }
        }
        else{ ?>
            <div class="empty-result">
                <h3>No products were added to the wishlist.</h3> 
            </div>
            <?php
        } ?>
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
    <script src="js/jquery-1.10.2.min.js"></script>
</body>

</html>