<?php
session_start();
$connect = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connect, "shopping-web");

//add to cart - db approach
if(isset($_POST["pid"]) && isset($_POST["pname"]) && isset($_POST["pprice"]) && isset($_POST["pimg"]) && isset($_POST["pcode"]))
{
    $id = $_POST["pid"];
    $name = $_POST["pname"];
    $price = $_POST["pprice"];
    $img = $_POST["pimg"];
    $code = $_POST["pcode"];
    $qty = 1;

    $cart_stmt = "SELECT product_code FROM cart WHERE product_code = '$code'";
    $cart_result = mysqli_query($connect, $cart_stmt) or die(mysqli_error($connect));

    $row = mysqli_fetch_array($cart_result);

    $check_code = $row["product_code"];

    if(!$check_code)
    {
        $insert_cart = "INSERT INTO `cart` (`product_title`, `product_price`, `product_img`, `quantity`, `total_price`, `product_code`) VALUES ('$name', '$price', '$img', '$qty', '$price', '$code')";

        $insert_cart_result = mysqli_query($connect, $insert_cart) or die(mysqli_error($connect));
        
        echo'
            <script>alert("Item added to your cart");</script>';
        
    }
    else
    {
        echo'
            <script>alert("Item already added to your cart");</script>';
    }
}

// get total cart items
if(isset($_GET["cartItem"]) && isset($_GET["cartItem"])=="cart_item")
{
    $total_cart = mysqli_query($connect, "SELECT * FROM cart");
    $cart_num = mysqli_num_rows($total_cart);
    if($cart_num > 0){
        echo $cart_num; 
    }
}

//delete from cart - db approach
if(isset($_GET["remove"]))
{
    $id = $_GET["remove"];
    $delete_query = "DELETE FROM cart WHERE cart_id = '$id'";
    $delete_query_result = mysqli_query($connect, $delete_query) or die(mysqli_error($connect));
    header("location: cart.php");
}

// delete all from cart
if(isset($_GET["clear"])){
    $id = $_GET["clear"];
    $delete_all = mysqli_query($connect, "DELETE FROM cart");
    header("location: cart.php");
}

//update item quantity in cart - db approach
if(isset($_POST["pqty"]))
{
    $qty = $_POST["pqty"];
    $id = $_POST["pid"];
    $price = $_POST["pprice"];

    $total_price = $qty * $price;

    $update_cart = "UPDATE cart SET quantity = '$qty', total_price = '$total_price' WHERE cart_id = '$id'";
    $update_result = mysqli_query($connect, $update_cart) or die(mysqli_error($connect));
}

//checkout
if(isset($_POST["action"]) && isset($_POST["action"])=="order")
{
    $orderId = $_POST["order_id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $pmode = $_POST["pmode"];
    $products = $_POST["products"];
    $grand_total = $_POST["grand_total"];

    // $data = "";

    $insert_order = "INSERT INTO `orders` (`username`, `email`, `phone`, `address`, `payment_mode`, `products`, `paid_amount`, `order_date`) VALUES ('$name', '$email', '$phone', '$address', '$pmode', '$products', '$grand_total', current_timestamp())";
    $insert_execute = mysqli_query($connect, $insert_order) or die(mysqli_error($connect));

    // $data= '<div class="data-area">
    //             <h1>Thank You!</h1>
    //             <h2>Your Order Placed Successfully!</h2>
    //             <h4>Products Purchased: '.$products.'</h4>
    //             <h4>Your Name: '.$name.'</h4>
    //             <h4>Your Email: '.$email.'</h4>
    //             <h4>Your Phone: '.$phone.'</h4>
    //             <h4>Total Amount: '.$grand_total.'</h4>
    //             <h4>Payment Mode: '.$pmode.'</h4>
    //         </div>';
    // echo $data;
}

//add products in cart
// if(isset($_POST['addToCart'])){
//     $p_id = $_POST['addToCart'];
    
//     if(isset($_COOKIE['user_cart'])){
//         $user_cart = json_decode($_COOKIE['user_cart']);
//     }else{
//         $user_cart = [];
//     }
//     if(!in_array($p_id,$user_cart)){
//         array_push($user_cart,$p_id);
//     }
    
//     $cart_count = count($user_cart);
//     $u_cart = json_encode($user_cart);

//     if(setcookie('user_cart',$u_cart,time() + (1000),'/','','',TRUE)){
//         setcookie('cart_count',$cart_count,time() + (1000),'/','','',TRUE);
//         echo 'cookie set successfully';
//     }else{
//         echo 'false';
//     }
// }

// remove products from cart
// if(isset($_POST['removeCartItem'])){
//     $p_id = $_POST['removeCartItem'];
    
//     if($_COOKIE['cart_count'] == '1'){
//         setcookie('cart_count','',time() - (180),'/','','',TRUE);
//         setcookie('user_cart','',time() - (180),'/','','',TRUE);
//     }else{
//         if(isset($_COOKIE['user_cart'])){
//             $user_cart = json_decode($_COOKIE['user_cart']);
//             if(is_object($user_cart)){
//                 $user_cart = get_object_vars($user_cart);
//             }
//             if (($key = array_search($p_id, $user_cart)) !== false) {
//                 unset($user_cart[$key]);
//             }
//         }
//         $cart_count = count($user_cart);
//         $u_cart = json_encode($user_cart);

//         if(setcookie('user_cart',$u_cart,time() + (180),'/','','',TRUE)){
//             setcookie('cart_count',$cart_count,time() + (180),'/','','',TRUE);
//             echo 'cookie set successfully';
//         }else{
//             echo 'false';
//         }
//     }
// }

// add products in wishlist
if(isset($_POST['addWishlist'])){
    $p_id = $_POST['addWishlist'];
    if(isset($_COOKIE['user_wishlist'])){
        $user_wishlist = json_decode($_COOKIE['user_wishlist']);
    }else{
        $user_wishlist = [];
    }
    if(!in_array($p_id,$user_wishlist)){    //in_array function search for the value in an array
        array_push($user_wishlist,$p_id);
    }

    $wishlist_count = count($user_wishlist);
    $u_wishlist = json_encode($user_wishlist);

    if(setcookie('user_wishlist',$u_wishlist,time() + (180),'/','','',TRUE)){
        setcookie('wishlist_count',$wishlist_count,time() + (180),'/','','',TRUE);
        echo 'cookie set successfully';
    }else{
        echo 'false';
    }
}

//remove products from wishlist
if(isset($_POST['removeWishlistItem'])){
    $p_id = $_POST['removeWishlistItem'];
    if($_COOKIE['wishlist_count'] == '1'){
        setcookie('wishlist_count','',time() - (180),'/','','',TRUE);
        setcookie('user_wishlist','',time() - (180),'/','','',TRUE);
    }else{
        if(isset($_COOKIE['user_wishlist'])){
            $user_wishlist = json_decode($_COOKIE['user_wishlist']);
            if(is_object($user_wishlist)){
                $user_wishlist = get_object_vars($user_wishlist);
            }
            if (($key = array_search($p_id, $user_wishlist)) !== false) {
                unset($user_wishlist[$key]);
            }
        }
        $wishlist_count = count($user_wishlist);
        $u_wishlist = json_encode($user_wishlist);

        if(setcookie('user_wishlist',$u_wishlist,time() + (180),'/','','',TRUE)){
            setcookie('wishlist_count',$wishlist_count,time() + (180),'/','','',TRUE);
            echo 'cookie set successfully';
        }else{
            echo 'false';
        }
    }
}

?>