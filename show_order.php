<?php
include 'header.php';
// $order_no = $_GET["order_id"];
?>

<section id="orders-section" class="section-pad1">
    <?php
    include 'dbconnect.php';
    $select_stmt = mysqli_query($conn, "SELECT *, DATE_FORMAT(order_date, '%D of %M, %Y at %h:%i %p') AS formatted_date FROM orders ORDER BY order_id DESC") or die(mysqli_error($conn));
    $row = mysqli_fetch_assoc($select_stmt); ?>
    
        <h2>Thank You!</h2>
        <h4>Your Order Placed Successfully!</h4>
        <p>< The Delivery will take 3-5 working days ></p>

        <div class="products-purchased">
            <h4>Products Purchased:</h4>
            <span><?php echo $row['products'] ?></span>
        </div>

        <div class="order-details">
            <table>
                <tbody>
                    <tr>
                        <th>Name</th>
                        <td><?php echo $row['username'] ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?php echo $row['email'] ?></td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td><?php echo $row['phone'] ?></td>
                    </tr>
                    <tr>
                        <th>Total Amount</th>
                        <td><?php echo $row['paid_amount'] ?></td>
                    </tr>
                    <tr>
                        <th>Payment Mode</th>
                        <td><?php echo $row['payment_mode'] ?></td>
                    </tr>
                    <tr>
                        <th>Order Placed at</th>
                        <td><?php echo $row['formatted_date'] ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="orders-options">
            <a href="index.php"><button class="white"><i class="fa-solid fa-arrow-left"></i> Go To Homepage</button></a>
            <a href="user_orders.php"><button class="white">Track Your Order <i class="fa-solid fa-arrow-right"></i></button></a>
        </div>
</section>

<?php include 'footer.php' ?>
