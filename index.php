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
include 'header.php';
?>

<!-- Top Banner Section -->
<section id="hero">
    <div class="fadeInLeft animate">
        <div class="animate fadeInDown">
            <h4>Trade-in-offer</h4>
            <h2>Super value deals</h2>
            <h1>On all our products</h1>
            <p>Save more with coupon & up to 70% off!</p>
        </div>
    </div>
    <div class="fadeInTop animate">
        <button class="fadeInLeft animate"><a href="shop.php" style="text-decoration: none;">Shop Now</a></button>
    </div>
</section>

<!-- Featured Section -->
<section id="feature" class="section-pad1">
    <div class="feature-box">
        <img src="img/features/f1.png" alt="">
        <h6>Free Shipping</h6>
    </div>
    <div class="feature-box">
        <img src="img/features/f_1.png" alt="">
        <h6>Online Order</h6>
    </div>
    <div class="feature-box">
        <img src="img/features/f_3.png" alt="">
        <h6>Save Money</h6>
    </div>
    <div class="feature-box">
        <img src="img/features/f_4.png" alt="">
        <h6>Promotions</h6>
    </div>
    <div class="feature-box">
        <img src="img/features/f_5.png" alt="">
        <h6>Happy Sell</h6>
    </div>
    <div class="feature-box">
        <img src="img/features/f_6.png" alt="">
        <h6>24/7 Support</h6>
    </div>
</section>

<!-- Featured Products Section -->
<section id="product1" class="section-pad1">
    <h2>Featured Products</h2>
    <p>Shop our most viewed products.</p>

    <div class="pro-container">

        <?php
        $featuredQuery = "SELECT products.product_id, products.product_title, products.product_code, products.product_price, products.product_img, products.product_cat, products.product_sub_cat, sub_categories.sub_cat_id, sub_categories.sub_cat_title FROM products, sub_categories WHERE products.product_sub_cat = sub_categories.sub_cat_id AND products.product_views >= 10";
        $featured_products = mysqli_query($connect, $featuredQuery);
        if (mysqli_num_rows($featured_products) > 0) {
            foreach ($featured_products as $f_rows) {
        ?>
                <div class="pro">
                    <form class="form-submit">
                        <a href="single_product.php?pid=<?php echo $f_rows['product_id']; ?>">
                            <img src="<?php echo $f_rows['product_img'] ?>" alt="">
                        </a>

                        <div class="desc">
                            <span>
                                <?php echo $f_rows['sub_cat_title'] ?>
                            </span>
                            <a href="single_product.php?pid=<?php echo $f_rows['product_id']; ?>">
                                <h5><?php echo $f_rows['product_title'] ?></h5>
                            </a>
                            <div class="star">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>

                            <h4>
                                Rs. <?php echo $f_rows['product_price'] ?>
                            </h4>
                        </div>
                        <input type="hidden" name="quantity" class="quantity" value="1">
                        <input type="hidden" name="hidden_pid" class="hidden_pid" value="<?php echo $f_rows['product_id'] ?>">
                        <input type="hidden" name="hidden_img" class="hidden_img" value="<?php echo $f_rows['product_img'] ?>">
                        <input type="hidden" name="hidden_name" class="hidden_name" value="<?php echo $f_rows['product_title'] ?>">
                        <input type="hidden" name="hidden_price" class="hidden_price" value="<?php echo $f_rows['product_price'] ?>">
                        <input type="hidden" name="hidden_code" class="hidden_code" value="<?php echo $f_rows['product_code'] ?>">

                        <a href="" class="add-to-wishlist" data-id="<?php echo $f_rows['product_id']; ?>"><i class="wish-icon fa-solid fa-heart"></i></a>

                        <a href="" class="add_Cart"><i class="cart-icon fa-solid fa-cart-shopping"></i></a>

                        <!-- <button type="submit" name="add_to_cart"><a href="#"><i class="cart-icon fa-solid fa-cart-shopping"></i></a></button> -->
                    </form>
                </div>
        <?php
            }
        } ?>
    </div>
</section>

<!-- Call to action Section -->
<section id="banner" class="section-marg1">
    <h4>Repair Service</h4>
    <h2>Up to <span>70% Off</span> - All T-shirts & Accessories</h2>
    <button class="normal">Explore More</button>
</section>

<!-- New Arrivals -->
<section id="product1" class="section-pad1">
    <h2>New Arrivals</h2>
    <p>Summer Collection New Modern Design</p>

    <div class="pro-container">
        <?php
        $newArrivalQuery = "SELECT products.product_id, products.product_title, products.product_code, products.product_price, products.product_img, products.product_cat, products.product_sub_cat, sub_categories.sub_cat_id, sub_categories.sub_cat_title FROM products, sub_categories WHERE products.product_sub_cat = sub_categories.sub_cat_id ORDER BY products.product_id DESC LIMIT 8";
        $newArrivalResult = mysqli_query($connect, $newArrivalQuery) or die(mysqli_error($connect));

        if (mysqli_num_rows($newArrivalResult) > 0) {
            while ($rows = mysqli_fetch_assoc($newArrivalResult)) {
        ?>
                <div class="pro">
                    <form class="form-submit">
                        <a href="single_product.php?pid=<?php echo $rows['product_id']; ?>">
                            <img src="<?php echo $rows['product_img'] ?>" alt="">
                        </a>

                        <div class="desc">
                            <span>
                                <?php echo $rows['sub_cat_title'] ?>
                            </span>
                            <a href="single_product.php?pid=<?php echo $rows['product_id']; ?>">
                                <h5><?php echo $rows['product_title'] ?></h5>
                            </a>
                            <div class="star">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>

                            <h4>
                                Rs. <?php echo $rows['product_price'] ?>
                            </h4>
                        </div>
                        <input type="hidden" name="quantity" class="quantity" value="1">
                        <input type="hidden" name="hidden_pid" class="hidden_pid" value="<?php echo $rows['product_id'] ?>">
                        <input type="hidden" name="hidden_img" class="hidden_img" value="<?php echo $rows['product_img'] ?>">
                        <input type="hidden" name="hidden_name" class="hidden_name" value="<?php echo $rows['product_title'] ?>">
                        <input type="hidden" name="hidden_price" class="hidden_price" value="<?php echo $rows['product_price'] ?>">
                        <input type="hidden" name="hidden_code" class="hidden_code" value="<?php echo $rows['product_code'] ?>">

                        <a href="" class="add-to-wishlist" data-id="<?php echo $rows['product_id']; ?>"><i class="wish-icon fa-solid fa-heart"></i></a>

                        <a href="" class="add_Cart"><i class="cart-icon fa-solid fa-cart-shopping"></i></a>

                        <!-- <button type="submit" name="add_to_cart"><a href="#"><i class="cart-icon fa-solid fa-cart-shopping"></i></a></button> -->
                    </form>
                </div>
        <?php
            }
        } ?>
    </div>
</section>

<!-- Deals Call to Action Section -->
<!-- <section id="sm-banner" class="section-pad1">
        <div class="banner-box">
            <h4>crazy deals</h4>
            <h2>buy 1 get 1 free</h2>
            <span>The best classic dress is on sale at cara</span>
            <button class="white">Learn More</button>
        </div>
        <div class="banner-box banner-box2">
            <h4>spring/summer</h4>
            <h2>upcoming season</h2>
            <span>The best classic dress is on sale at cara</span>
            <button class="white">Collection</button>
        </div>
    </section> -->

<!-- Text Banner -->
<!-- <section id="banner3">
        <div class="banner-box">
            <h2>SEASON SALE</h2>
            <h3>Winter Collection -50% OFF</h3>
        </div>
        <div class="banner-box banner-box2">
            <h2>NEW FOOTWEAR COLLECTION</h2>
            <h3>Spring / Summer 2022</h3>
        </div>
        <div class="banner-box banner-box3">
            <h2>T-SHIRTS</h2>
            <h3>New Trendy Prints</h3>
        </div>
    </section> -->

<!-- NewsLetter -->
<section id="newsletter" class="section-pad1 section-marg1">
    <div class="newstext">
        <h4>Sign Up for Newsletters</h4>
        <p>Get E-mail updates about our latest shop and <span>special offers.</span></p>
    </div>

    <div class="form">
        <input type="text" placeholder="Your email address">
        <button class="normal">Sign up</button>
    </div>
</section>

<?php include 'footer.php' ?>