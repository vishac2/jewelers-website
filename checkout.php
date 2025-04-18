<?php
session_start();

$host = 'localhost';
$dbname = 'jewellers';
$username = 'root';
$password = '';

try {
    // Create PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login if user is not logged in
    exit;
}

// Fetch the current user's cart items
$query = "SELECT cart.*, products.name, products.price 
          FROM cart 
          JOIN products ON cart.product_id = products.id 
          WHERE cart.user_id = :user_id";
$stmt = $pdo->prepare($query);
$stmt->execute(['user_id' => $_SESSION['user_id']]);
$cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total_price = 0;
if ($cart_items) {
    foreach ($cart_items as $item) {
        $total_price += $item['price'] * $item['quantity'];
    }
}
?>
<?php if (isset($_SESSION['success_message'])): ?>
    <div class="success-message">
        <?php
        echo htmlspecialchars($_SESSION['success_message']);
        unset($_SESSION['success_message']); // Clear the message after displaying it
        ?>
    </div>
<?php endif; ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="store.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="store.php">Store</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>Checkout</h1>

        <?php if ($cart_items): ?>
            <table border="1">
                <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
                <?php foreach ($cart_items as $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['name']); ?></td>
                        <td>$<?php echo number_format($item['price'], 2); ?></td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td>$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="3"><strong>Total</strong></td>
                    <td><strong>$<?php echo number_format($total_price, 2); ?></strong></td>
                </tr>
            </table>

            <form action="process_checkout.php" method="POST">
                <h3>Shipping Information</h3>
                <label for="shipping_address">Address:</label>
                <textarea id="shipping_address" name="shipping_address" required></textarea>
                <button type="submit">Complete Purchase</button>
            </form>
        <?php else: ?>
            <p>Your cart is empty.</p>
        <?php endif; ?>
    </main>

    <footer>
        <div class="footer-content">
            <h3>Kothari Jewellers</h3>
            <p>&copy; <?php echo date("Y"); ?> All rights reserved.</p>
            <!-- Contact Details -->
        </div>
    </footer>
</body>
</html>
