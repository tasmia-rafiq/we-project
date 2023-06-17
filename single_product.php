<?php
session_start();
$p_id = $_GET['pid'];
$connect = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connect, "shopping-web");

$update_views = mysqli_query($connect, "UPDATE products SET product_views = product_views+1 WHERE product_id = '$p_id'");

include 'header.php';


$spQuery = "SELECT * FROM products WHERE product_id = '$p_id'";
$single_product = mysqli_query($connect, $spQuery) or die(mysqli_error($connect));
if(mysqli_num_rows($single_product) > 0) 
{
    ?>
    <!-- Product Details Section -->
    <section id="prodetails" class="section-pad1">

        <?php
        foreach($single_product as $rows){ ?>
            <div class="single-pro-image">
                <img src="<?php echo $rows['product_img'] ?>" width="100%" id="mainImg" alt="">

                <div class="small-img-group">
                    <div class="small-img-col">
                        <img src="<?php echo $rows['product_img'] ?>" width="100%" class="small-img" alt="">
                    </div>

                    <div class="small-img-col">
                        <img src="<?php echo $rows['p_img2'] ?>" width="100%" class="small-img" alt="">
                    </div>

                    <div class="small-img-col">
                        <img src="<?php echo $rows['p_img3'] ?>" width="100%" class="small-img" alt="">
                    </div>

                    <div class="small-img-col">
                        <img src="<?php echo $rows['p_img4'] ?>" width="100%" class="small-img" alt="">
                    </div>
                </div>
            </div>

            <div class="single-pro-details">
                <form class="form-submit">
                    <a href="index.php" style="text-decoration: none;"><h5>Home</h5></a><br>
                    <hr>
                    <h4><?php echo $rows['product_title'] ?></h4>
                    <h2>Rs. <?php echo $rows['product_price'] ?></h2>

                    <select>
                        <option>Select</option>
                        <option>XL</option>
                        <option>XXL</option>
                        <option>Small</option>
                        <option>Medium</option>
                        <option>Large</option>
                    </select>

                    <button class="wishlistBtn"><a href="" class="add-to-wishlist" data-id="<?php echo $rows['product_id'] ?>"><i class="wish-icon fa-solid fa-heart"></i></a></button>

                    <!-- The following code will hidden values like, id, title image price and then send it to the cart -->
                    <input type="hidden" name="quantity" class="quantity" value="1">
                    <input type="hidden" name="hidden_pid" class="hidden_pid" value="<?php echo $rows['product_id'] ?>">
                    <input type="hidden" name="hidden_img" class="hidden_img" value="<?php echo $rows['product_img'] ?>">
                    <input type="hidden" name="hidden_name" class="hidden_name" value="<?php echo $rows['product_title'] ?>">
                    <input type="hidden" name="hidden_price" class="hidden_price" value="<?php echo $rows['product_price'] ?>">
                    <input type="hidden" name="hidden_code" class="hidden_code" value="<?php echo $rows['product_code'] ?>">
                    <!-- // -->

                    <a style="text-decoration: none; color: #fff;" href="" class="add_Cart"><button class="normal">Add To Cart</button></a>

                    <h4>Product Details</h4>
                    <span><?php echo $rows['product_desc'] ?></span>
                </form>
            </div>
            <?php
        } ?>
    </section>
    <?php
    } ?>

    <!-- Featured Products -->
    <?php include 'featured_products.php'; ?>

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

    <!-- JS For Slider -->
    <script>
        var mainImg = document.getElementById('mainImg');
        var smallImg = document.getElementsByClassName('small-img');

        smallImg[0].onclick = function () {
            mainImg.src = smallImg[0].src;
        }
        smallImg[1].onclick = function () {
            mainImg.src = smallImg[1].src;
        }
        smallImg[2].onclick = function () {
            mainImg.src = smallImg[2].src;
        }
        smallImg[3].onclick = function () {
            mainImg.src = smallImg[3].src;
        }

    </script>


<?php include 'footer.php'; ?>