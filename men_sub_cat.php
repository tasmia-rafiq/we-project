<?php
session_start();
$connect = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connect, "shopping-web");

$cat = $_GET['cat'];
$query = "SELECT sub_cat_title FROM sub_categories WHERE sub_cat_id = {$cat}";
$result = mysqli_query($connect, $query) or die(mysqli_error($connect));

?>
<?php include 'header.php'; ?>

    <!-- Top Banner Section -->
    <section id="shop-header" class="men-header">
    </section>

    <!-- Category Section -->
    <section id="search-result" class="section-pad1">
        <div class="result-area">
            <div class="related-cat">
                <?php
                $catQuery = 'SELECT sub_cat_id, sub_cat_title FROM sub_categories WHERE cat_parent = "11"';
                $result = mysqli_query($connect, $catQuery) or die(mysqli_error($connect)); 
                ?>
                <h3>Related Categories</h3>
                    <ul>
                        <li><a href="men.php">All</a></li>
                        <?php 
                            while ($rows = mysqli_fetch_assoc($result)) 
                            { ?>
                                <li>
                                    <a href="men_sub_cat.php?cat=<?php echo $rows['sub_cat_id']; ?>"><?php echo $rows['sub_cat_title']; ?></a>
                                </li>
                            <?php
                            }
                            ?>
                    </ul>
                
            </div>

            <div class="search-items">
                <section id="product1">
                    <div class="pro-container">

                        <?php

                        $men_sub_Query = "SELECT products.product_id, products.product_title, products.product_code, products.product_price, products.product_img, products.product_cat, products.product_sub_cat, sub_categories.sub_cat_id, sub_categories.sub_cat_title FROM products, sub_categories WHERE products.product_sub_cat = sub_categories.sub_cat_id AND products.product_sub_cat = '{$cat}' OR products.product_cat = '{$cat}' ORDER BY products.product_id DESC";

                        // "SELECT * FROM products WHERE product_sub_cat = '{$cat}' OR product_cat = '{$cat}' AND product_status = 1 AND qty > 0"
                        $result3 = mysqli_query($connect, $men_sub_Query) or die(mysqli_error($connect));

                        if (count((array)$result3) > 0) {
                            while($row3 = mysqli_fetch_assoc($result3)) 
                            {
                                ?>
                                <div class="pro">
                                    <form class="form-submit">
                                        <a href="single_product.php?pid=<?php echo $row3['product_id']; ?>">
                                            <img src="<?php echo $row3['product_img'] ?>" alt="" >
                                        </a>
                                        
                                        <div class="desc">
                                            <span>
                                                <?php echo $row3['sub_cat_title'] ?>
                                            </span>
                                            <a href="single_product.php?pid=<?php echo $row3['product_id']; ?>">
                                                <h5><?php echo $row3['product_title'] ?></h5>
                                            </a>
                                            <div class="star">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>

                                            <h4>
                                                Rs. <?php echo $row3['product_price'] ?>
                                            </h4>
                                        </div>
                                        <input type="hidden" name="quantity" class="quantity" value="1">
                                        <input type="hidden" name="hidden_pid" class="hidden_pid" value="<?php echo $row3['product_id'] ?>">
                                        <input type="hidden" name="hidden_img" class="hidden_img" value="<?php echo $row3['product_img'] ?>">
                                        <input type="hidden" name="hidden_name" class="hidden_name" value="<?php echo $row3['product_title'] ?>">
                                        <input type="hidden" name="hidden_price" class="hidden_price" value="<?php echo $row3['product_price'] ?>">
                                        <input type="hidden" name="hidden_code" class="hidden_code" value="<?php echo $row3['product_code'] ?>">

                                        <a href="" class="add-to-wishlist" data-id="<?php echo $row3['product_id']; ?>"><i class="wish-icon fa-solid fa-heart"></i></a>

                                        <a href="" class="add_Cart"><i class="cart-icon fa-solid fa-cart-shopping"></i></a>

                                        <!-- <button type="submit" name="add_to_cart"><a href="#"><i class="cart-icon fa-solid fa-cart-shopping"></i></a></button> -->
                                    </form>
                                </div>
                            <?php
                            }
                        }
                        else
                        { ?>
                            <div class="empty-result">!!! Result Not Found !!!</div>
                            
                            <?php 
                        } ?>
                    </div>
                </section>
            </div>
        </div>
    </section>

<?php include 'footer.php' ?>
