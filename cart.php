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

// Add to cart logic
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $user_id = $_SESSION['user_id'];  // Assuming user is logged in

    // Check if product is already in the cart
    $query = "SELECT * FROM cart WHERE product_id = :product_id AND user_id = :user_id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['product_id' => $product_id, 'user_id' => $user_id]);
    $cart_item = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($cart_item) {
        // If the product is already in the cart, update the quantity
        $new_quantity = $cart_item['quantity'] + 1;
        $update_query = "UPDATE cart SET quantity = :quantity WHERE product_id = :product_id AND user_id = :user_id";
        $update_stmt = $pdo->prepare($update_query);
        $update_stmt->execute(['quantity' => $new_quantity, 'product_id' => $product_id, 'user_id' => $user_id]);
    } else {
        // If the product is not in the cart, insert it
        $insert_query = "INSERT INTO cart (user_id, product_id, quantity) VALUES (:user_id, :product_id, 1)";
        $insert_stmt = $pdo->prepare($insert_query);
        $insert_stmt->execute(['user_id' => $user_id, 'product_id' => $product_id]);
    }

    header("Location: cart.php"); // Redirect back to the cart page after adding to cart
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="stylesheet" href="store.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="store.php">Store</a></li>
                <li><a href="checkout.php">Checkout</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>Your Cart</h1>

        <table border="1">
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
            <?php if ($cart_items): ?>
                <?php foreach ($cart_items as $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['name']); ?></td>
                        <td>$<?php echo number_format($item['price'], 2); ?></td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td>$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Your cart is empty.</td>
                </tr>
            <?php endif; ?>
        </table>
    </main>

     <footer>
    <div class="footer-content">
        <h3>Kothari Jewellers</h3>
        <p>&copy; <?php echo date("Y"); ?> All rights reserved.</p>
        
        <div class="contact-details">
            <h4>Contact Us</h4>
            <p><strong>Phone:</strong> (123) 456-7890</p>
            <p><strong>Email:</strong> <a href="mailto:info@yourjewellers.com">info@yourjewellers.com</a></p>
            <p><strong>Address:</strong> 1234 Jewellers Lane, City, State, ZIP</p>
        </div>

        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="categories.php">Categories</a></li>
                <li><a href="store.php">Store</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
        
        <div class="socials">
            <a href="https://www.facebook.com" target="_blank">Facebook</a>
            <a href="https://www.instagram.com" target="_blank">Instagram</a>
            <a href="https://www.twitter.com" target="_blank">Twitter</a>
        </div>
    </div>
</footer>

</body>
</html>
