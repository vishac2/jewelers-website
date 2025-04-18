<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jewelry Store</title>
    <link rel="stylesheet" href="store.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="cart.php">View Cart</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>Our Products</h1>
        <div id="products">
            <!-- Product 1 -->
            <div class="product">
                <img src="ring.jpg" alt="Rose Gold Ring">
                <h2>Rose Gold Ring</h2>
                <p>Beautiful rose gold ring with a floral design.</p>
                <p>Price: $500.99</p>
                <form method="post" action="add_to_cart.php">
                    <input type="hidden" name="product_name" value="Rose Gold Ring">
                    <input type="hidden" name="price" value="500.99">
                    <button type="submit">Add to Cart</button>
                </form>
            </div>
            <!-- Repeat similar blocks for other products -->
        </div>
    </main>

    <footer>
        <div class="footer-content">
            <p>&copy; 2024 Jewelry Store</p>
        </div>
    </footer>
</body>
</html>

<?php
// Connect to MySQL database
$servername = "localhost";
$username = "root"; // or your database username
$password = ""; // or your database password
$dbname = "jewellers";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission (adding to cart)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];

    // Insert the product into the cart table
    $sql = "INSERT INTO cart (product_name, price) VALUES ('$product_name', '$price')";

    if ($conn->query($sql) === TRUE) {
        echo "Product added to cart!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
