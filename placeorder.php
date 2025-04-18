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

// Get shipping address and total amount from the form
$shipping_address = $_POST['shipping_address'];
$total_amount = $_POST['total_amount'];
$user_id = $_SESSION['user_id'];

// Insert order into the orders table
$order_query = "INSERT INTO orders (customer_id, order_date, status, total_amount, payment_method, shipping_address) VALUES (?, NOW(), 'Pending', ?, 'Online', ?)";
$order_stmt = $pdo->prepare($order_query);

// Execute the order insert
if ($order_stmt->execute([$user_id, $total_amount, $shipping_address])) {
    // Clear the cart after successful order placement
    $delete_query = "DELETE FROM cart WHERE user_id = :user_id";
    $delete_stmt = $pdo->prepare($delete_query);
    $delete_stmt->execute(['user_id' => $user_id]);

    echo "Order placed successfully!";
    echo "<br><a href='store.php'>Continue Shopping</a>";
} else {
    echo "Error placing order.";
}

// Close the database connection
$pdo = null;
?>
