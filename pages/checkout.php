<?php include '../includes/header.php'; ?>
<?php include '../includes/arrays.php'; ?>

<h2>Checkout</h2>
<form method="post">
    <label>Payment Method:</label>
    <select name="payment">
        <option>Online (Razorpay)</option>
        <option>Pay at Store</option>
    </select>
    <button type="submit" name="place_order">Place Order</button>
</form>

<?php
if (isset($_POST['place_order'])) {
    echo "<p>Order Placed! (This is mock — real payment can be added later)</p>";
}
?>

<?php include '../includes/footer.php'; ?>
