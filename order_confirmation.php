<?php
session_start();
if (!isset($_GET['order_id'])) {
    header("Location: index.php");
    exit;
}
$order_id = $_GET['order_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="store.css">
</head>
<body>
    <header>
        <h1>Order Confirmation</h1>
    </header>
    <main>
        <p>Thank you for your purchase! Your order ID is <strong>#<?php echo htmlspecialchars($order_id); ?></strong>.</p>
        <a href="index.php">Return to Store</a>
    </main>
</body>
</html>
