<?php
$connect = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connect, "shopping-web");
?>

    <section id="product1" class="section-pad1">
        <h2>Featured Products</h2>
        <p>Shop our most viewed products.</p>

        <div class="pro-container">

        <?php 
        $featuredQuery = "SELECT products.product_id, products.product_code, products.product_title, products.product_price, products.product_img, products.product_cat, products.product_sub_cat, sub_categories.sub_cat_id, sub_categories.sub_cat_title FROM products, sub_categories WHERE products.product_sub_cat = sub_categories.sub_cat_id AND products.product_views >= 2";
        $featured_products = mysqli_query($connect, $featuredQuery) or die(mysqli_error($connect));
        if(mysqli_num_rows($featured_products) > 0)
        {
            foreach($featured_products as $f_rows) {
                ?>
            <div class="pro">
                <form class="form-submit">
                    <a href="single_product.php?pid=<?php echo $f_rows['product_id']; ?>">
                        <img src="<?php echo $f_rows['product_img'] ?>" alt="" >
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