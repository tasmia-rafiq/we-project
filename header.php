<?php 
$connect = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connect, "shopping-web");
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Website</title>
    <link rel="stylesheet" href="css/style.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Fonts -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Baskervville:regular,italic%7CLexend:300,regular,500"
        media="all" />

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />

</head>

<body>

    <!-- Navigation Bar -->
    <section id="header">
        <a href="index.php"><img src="img/logo-color.png" class="logo" alt=""></a>

        <div>
            <ul id="navbar">
                <li id="cat-header">
                    <form action="search.php" method="GET">
                        <div class="input-group search">
                            <input type="text" class="form-control" name="search" placeholder="Search for...">
                            <span class="input-group-btn">
                                <button class="normal" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                            </span>
                        </div>
                    </form>
                </li>
                <li><a href="index.php">Home</a></li>
                <li>
                    <div class="shop-dropdown">
                        <a href="shop.php" class="shop-dropBtn">Shop <i class="fa -solid fa-fa fa-caret-down"></i></a>
                        <div class="shop-dropdown-content">
                            <a href="men.php">Men</a>
                            <a href="women.php">Women</a>
                            <a href="kids.php">Kids</a>
                        </div>

                    </div>
                </li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li id="lg-bag">
                    <a href="cart.php"><i class="fa-solid fa-bag-shopping"></i>
                        <span id="cart-item"></span>
                    </a>
                </li>
                <li id="lg-bag">
                    <a href="wishlist.php"><i class="fa-solid fa-heart"></i>
                        <?php if(isset($_COOKIE['wishlist_count'])){
                                    echo '<span>'.$_COOKIE["wishlist_count"].'</span>';
                                } ?>
                    </a>
                </li>

                <li class="dropdown">
                    
                        <button onclick="myFunction()" class="dropbtn">
                            <?php
                            if (session_status() == PHP_SESSION_NONE) {
                                session_start();
                            }
                            if(isset($_SESSION["user_role"])){ ?>
                                <?php echo $_SESSION["username"]; ?> <i class="fa fa-caret-down"></i>
                            <?php  }else{ ?>
                                <i class="fa fa-user"></i>
                            <?php  } ?>
                            
                        </button>
                    
                    <ul id="myDropdown" class="dropdown-content">
                            <!-- Trigger the modal with a button -->
                        <?php
                            if(isset($_SESSION["user_role"])){ ?>
                                <li><a href="user_profile.php" class="" >My Profile</a></li>
                                <li><a href="user_orders.php" class="" >My Orders</a></li>
                                <li><a href="logout.php" class="user_logout" >Logout</a></li>
                        <?php  }else{ ?>
                                <li><a href="login.php">login</a></li>
                                <li><a href="register.php">Register</a></li>
                          <?php  } ?>

                    </ul>
                </li>
                <a href="#" id="close"><i class="fa-solid fa-xmark"></i></a>
            </ul>
        </div>

        <div id="mobile">
            <a href="cart.html"><i class="fa-solid fa-bag-shopping"></i></a>
            <i id="bar" class="fas fa-outdent"></i>
        </div>

        
    </section>
    <!-- <section id="cat-header">
        <div>
            <ul id="navbar">
                <?php  
                $result = mysqli_query($connect, "SELECT * from categories");
                while ($rows = mysqli_fetch_assoc($result)) 
                {
                    ?>
                    <li><a href="category.php?cat=<?php echo $rows['cat_id']; ?>"><?php echo $rows['cat_title']; ?></a></li>
                            
                    <?php
                }
                    ?>

                    <li>
                        <form action="search.php" method="GET">
                            <div class="input-group search">
                                <input type="text" class="form-control" name="search" placeholder="Search for...">
                                <span class="input-group-btn">
                                    <button class="normal" type="submit">Search</button>
                                </span>
                            </div>
                        </form>
                    </li>

            </ul>
        </div>
    </section> -->
