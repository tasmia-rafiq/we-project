<?php
include 'dbconnect.php';
include 'header.php';
?>

<!-- Top Banner Section -->
    <section id="shop-header" class="cart-header">
        <h2 class="fadeInDown animate">My_WishList</h2>
        <p class="fadeInTop animate">Find Your Favorites HERE!</p>
    </section>

    <section id="cart" class="section-pad1">
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
                $wishlist = mysqli_query($conn, $wishlistQuery) or die(mysqli_error($conn));
                    
                    if(mysqli_num_rows($wishlist) > 0)
                    { ?>
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
<hr>

<?php include 'footer.php'; ?>
