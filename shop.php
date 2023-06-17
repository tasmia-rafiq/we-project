<?php
session_start();
$connect = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connect, "shopping-web");
include 'pagination.php';

if(isset($_POST["add_to_cart"]))
{
    if(isset($_SESSION["shopping_cart"]))
    {
        $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
        if(!in_array($_GET["id"], $item_array_id))
        {
            $count = count($_SESSION["shopping_cart"]);
            $item_array = array (
                'item_id'   => $_GET["id"],
                'item_name'   => $_POST["hidden_name"],
                'item_price'   => $_POST["hidden_price"],
                'item_img'   => $_POST["hidden_img"],
                'item_quantity'   => $_POST["quantity"]
            );
            $_SESSION["shopping_cart"][$count] = $item_array;

        }
        else
        {
            echo '
                <script>
                    alert("Item Already Added");
                    window.location = "shop.php";
                </script>
            ';
        }
    }
    else
    {
        $item_array = array (
            'item_id'   => $_GET["id"],
            'item_name'   => $_POST["hidden_name"],
            'item_price'   => $_POST["hidden_price"],
            'item_img'   => $_POST["hidden_img"],
            'item_quantity'   => $_POST["quantity"]
        );
        $_SESSION["shopping_cart"][0] = $item_array;
    }
}
?>

    <!-- Navigation Bar -->
    <?php include 'header.php' ?>

    <!-- Top Banner Section -->
    <section id="shop-header">
        <h2 class="fadeInDown animate">Shop All Products</h2>
        <p class="fadeInTop animate">Save more with coupon & up to 70% off!</p>
    </section>

    <!-- All Products Section -->
    <section id="product1" class="section-pad1">
        <div class="pro-container">

        <?php
        $newQuery = "SELECT products.product_id, products.product_title, products.product_code, products.product_price, products.product_img, products.product_cat, products.product_sub_cat, sub_categories.sub_cat_id, sub_categories.sub_cat_title FROM products, sub_categories WHERE products.product_sub_cat = sub_categories.sub_cat_id ORDER BY RAND()";

        $result = mysqli_query($connect, $newQuery) or die(mysqli_error($connect));

        while ($rows = mysqli_fetch_assoc($result)) 
        {
        ?>
            <div class="pro">
                <form class="form-submit">
                    <a href="single_product.php?pid=<?php echo $rows['product_id']; ?>">
                        <img src="<?php echo $rows['product_img'] ?>" alt="" >
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

                    <!-- <input type="hidden" name="quantity" value="1">
                    <input type="hidden" name="hidden_img" id="hidden_img" value="<?php echo $rows['product_img'] ?>">
                    <input type="hidden" name="hidden_name" value="<?php echo $rows['product_title'] ?>">
                    <input type="hidden" name="hidden_price" value="<?php echo $rows['product_price'] ?>">

                    <a href="" class="add-to-wishlist" data-id="<?php echo $rows['product_id']; ?>"><i class="wish-icon fa-solid fa-heart"></i></a>

                    <a href="" class="add-to-cart" data-id="<?php echo $rows['product_id'] ?>"><i class="cart-icon fa-solid fa-cart-shopping"></i></a> -->
                    
                    <!-- <button type="submit" name="add_to_cart"><a href="#"><i class="cart-icon fa-solid fa-cart-shopping"></i></a></button> -->
                </form>
            </div>
            <?php 
        }
        ?>
        </div>
    </section>

    <!-- Pagination -->
    <section id="pagination" class="section-pad1">
        <a href="#">1</a>
        <a href="#">2</a>
        <a href="#"><i class="fa-solid fa-arrow-right-long"></i></a>
    </section>

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
