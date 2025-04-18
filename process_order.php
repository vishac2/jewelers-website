<?php
// Database configuration
$host = 'localhost';
$dbname = 'your_database_name'; // Change this to your database name
$username = 'your_username';      // Change this to your database username
$password = 'your_password';      // Change this to your database password

// Create a database connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$customer_id = $_POST['customer_id'];
$status = $_POST['status'];
$total_amount = $_POST['total_amount'];
$payment_method = $_POST['payment_method'];
$shipping_address = $_POST['shipping_address'];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO orders (customer_id, order_date, status, total_amount, payment_method, shipping_address) VALUES (?, NOW(), ?, ?, ?, ?)");
$stmt->bind_param("issss", $customer_id, $status, $total_amount, $payment_method, $shipping_address);

// Execute the statement
if ($stmt->execute()) {
    echo "Order placed successfully!";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
