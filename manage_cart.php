<?php
session_start();
// session_destroy();

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    if(isset($_POST['Add_to_cart']))
    {
        if(isset($_SESSION['cart']))
        {
            $myItems = array_column($_SESSION['cart'], 'Item_Name');
            if(in_array($_POST['Item_Name'], $myItems))
            {
                echo"<script>
                        alert('Item Already Added');
                        window.location.href='index.php';
                </script>";
            }
            else {
                $count = count($_SESSION['cart']);
                $_SESSION['cart'][$count] = array('image' => $_POST['image'],'brand' => $_POST['brand'], 'Item_Name' => $_POST['Item_Name'], 'price' => $_POST['price'],'Quantity' => 1);
                echo"<script>
                            alert('Item Added');
                            window.location.href='index.php';
                    </script>";
            }
        }
        else
        {
            $_SESSION['cart'][0] = array('image' => $_POST['image'],'brand' => $_POST['brand'], 'Item_Name' => $_POST['Item_Name'], 'price' => $_POST['price'],'Quantity' => 1);
            echo"<script>
                        alert('Item Added');
                        window.location.href='index.php';
                </script>";
        }
    }
}

?>