<?php
function getResult(){
    $val = $this->result;
    $this->result = array();
    return $val;
}
// include 'config.php';
if($_GET['search'] == ''){
    header("Location: " . $hostname);
}else {

    $connect = mysqli_connect("localhost", "root", "");
    $db = mysqli_select_db($connect, "shopping-web");
    // $db = new Database();
    // $db->select('options','site_title',null,null,null,null);
    // $result = $db->getResult();
    // if(!empty($result)){ 
    //     $title = $result[0]['site_title']; 
    // }else{ 
    //     $title = "Shopping Project";
    // }
    include 'header.php';  ?>
    <div class="product-section content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="section-head">Search Results</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 left-sidebar">
                    <?php
                      
                    $catQuery = 'SELECT sub_categories.sub_cat_id, sub_categories.sub_cat_title FROM products LEFT JOIN sub_categories ON products.product_cat = sub_categories.cat_parent WHERE products.product_title LIKE "%' . $_GET['search'] . '%" ';
                    $result = mysqli_query($connect, $catQuery);
                    
                    // $db = new Database();
                    // $search = $db->escapeString($_GET['search']);
                    // $db->sql('SELECT sub_categories.sub_cat_id,sub_categories.sub_cat_title FROM products
                    //         LEFT JOIN sub_categories ON products.product_cat = sub_categories.cat_parent
                    //         WHERE products.product_title LIKE "%' . $search . '%"');
                    // $result = $db->getResult();  ?>
                    <h3>Related Categories</h3>
                    <ul>
                        <?php 
                        while ($rows = mysqli_fetch_assoc($result)) 
                        { ?>
                            <li>
                                
                                <a href=""><?php echo $rows['sub_cat_title']; ?></a>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
                <section id="product1" class="section-pad1">
                    <div class="pro-container">
                        <?php
                        // $limit = 8;
                        // $db->select('products','*',null,"product_title LIKE '%{$search}%'",null,$limit);
                        // $result3 = $db->getResult();

                        $result3 = mysqli_query($connect, "SELECT * FROM products WHERE product_title LIKE '%{$_GET['search']}%'");
                        

                        if (count((array)$result3) > 0) {
                            while($row3 = mysqli_fetch_assoc($result3)) 
                            {
                                ?>
                                <div class="pro">
                                    <form action="index.php?action=add&id=<?php echo $row3['product_id']; ?>" method="POST">
                                        <img src="<?php echo $row3['product_img'] ?>" alt="">
                                        <div class="desc">
                                            <span>
                                                <?php echo $row3['product_code'] ?>
                                            </span>
                                            <h5>
                                                <?php echo $row3['product_title'] ?>
                                            </h5>
                                            <div class="star">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>

                                            <h4>
                                                $<?php echo $row3['product_price'] ?>
                                            </h4>
                                        </div>
                                        <input type="number" name="quantity" value="1">
                                        <input type="hidden" name="hidden_img" id="hidden_img" value="<?php echo $row3['product_img'] ?>">
                                        <input type="hidden" name="hidden_name" value="<?php echo $row3['product_title'] ?>">
                                        <input type="hidden" name="hidden_price" value="<?php echo $row3['product_price'] ?>">
                                        <input type="submit" name="add_to_cart" value="Cart">
                                        <!-- <button type="submit" name="add_to_cart"><a href="#"><i class="cart-icon fa-solid fa-cart-shopping"></i></a></button> -->
                                    </form>
                                </div>


                                <!-- <div class="col-md-3 col-sm-6">
                                    <div class="product-grid">
                                        <div class="product-image">
                                            <a class="image" href="single_product.php?pid=<?php echo $row3['product_id']; ?>">
                                                <img class="pic-1"
                                                    src="product-images/<?php echo $row3['featured_image']; ?>">
                                            </a>
                                            <div class="product-button-group">
                                                <a href="single_product.php?pid=<?php echo $row3['product_id']; ?>"><i
                                                        class="fa fa-eye"></i></a>
                                                <a href="" class="add-to-cart"
                                                data-id="<?php echo $row3['product_id']; ?>"><i
                                                        class="fa fa-shopping-cart"></i></a>
                                                <a href="" class="add-to-wishlist"
                                                data-id="<?php echo $row3['product_id']; ?>"><i
                                                        class="fa fa-heart"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <h3 class="title">
                                                <a href="single_product.php?pid=<?php echo $row3['product_id']; ?>"><?php echo substr($row3['product_title'],0,30).'...'; ?></a>
                                            </h3>
                                            <div class="price"><?php echo $cur_format; ?> <?php echo $row3['product_price']; ?></div>
                                        </div>
                                    </div>
                                </div> -->
                            <?php
                            }
                        } else {
                            ?>
                            <div class="empty-result">!!! Result Not Found !!!</div>
                        <?php } ?>
                        
                    </div>
                </section>
            </div>
        </div>
    </div>

<?php

} ?>