<?php
include 'dbconnect.php';

$grand_total = 0;
$allItems = "";
$items = array();

$select_stmt = "SELECT CONCAT(product_title, '(', quantity, ')') AS ItemQty, total_price FROM cart";
$select_execute = mysqli_query($conn, $select_stmt) or die(mysqli_error($conn));

while($row = mysqli_fetch_assoc($select_execute))
{
    $grand_total = $grand_total + $row["total_price"];
    $items[] = $row["ItemQty"];
}
$allItems = implode(", ", $items);

include 'header.php';
?>

<form method="POST" id="placeOrder" class="section-pad1">
    <h2>Complete Your order!</h2>
    <p><strong>Product(s): </strong><?php echo $allItems ?></p>
    <p><strong>Total Amount Payable:</strong> Rs. <?php echo $grand_total ?></p>

    <input type="hidden" name="products" value="<?php echo $allItems ?>">
    <input type="hidden" name="grand_total" value="<?php echo $grand_total ?>">
    <div class="form-group">
        <label>Name:</label>
        <input type="text" name="name" class="form-control" placeholder="Your Name" >
    </div>

    <div class="form-group">
        <label>E-mail:</label>
        <input type="email" name="email" class="form-control" placeholder="Your Email" >
    </div>

    <div class="form-group">
        <label>Phone:</label>
        <input type="tel" name="phone" class="form-control" placeholder="Your Phone" >
    </div>

    <div class="form-group">
        <label>Address:</label>
        <textarea name="address" class="form-control-message" rows="3" cols="10" placeholder="Your Address" ></textarea>
    </div>

    <div class="form-group">
        <label>Select Payment Method</label>
        <select name="pmode" class="form-control">
            <option value="">Select Payment Method</option>
            <option value="Cash On Delivery">Cash On Delivery</option>
            <option value="Card">Debit/Credit Card</option>
        </select>
    </div>

    <div class="form-group">
        <button class="white" type="submit">Place Order</button>
    </div>

</form>


<?php include 'footer.php' ?>
