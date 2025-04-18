<form action="place_order.php" method="POST">
    <h3>Shipping Information</h3>
    <label for="shipping_address">Address:</label>
    <textarea id="shipping_address" name="shipping_address" required></textarea>
    <input type="hidden" name="total_amount" value="<?php echo $total_price; ?>"> <!-- This should have a value -->
    <button type="submit">Place Order</button>
</form>
