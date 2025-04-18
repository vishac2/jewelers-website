<?php
session_start();

$host = 'localhost';
$dbname = 'jewellers';
$username = 'root';
$password = '';

$name = $email = $password = "";
$name_err = $email_err = $password_err = "";
$success_msg = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["name"]))) {
        $name_err = "Please enter your name.";
    } else {
        $name = trim($_POST["name"]);
    }

    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email.";
    } elseif (!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
        $email_err = "Invalid email format.";
    } else {
        $query = "SELECT id FROM users WHERE email = :email";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':email', trim($_POST["email"]));
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $email_err = "This email is already taken.";
        } else {
            $email = trim($_POST["email"]);
        }
    }

    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have at least 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    if (empty($name_err) && empty($email_err) && empty($password_err)) {
        $query = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', password_hash($password, PASSWORD_DEFAULT));

        if ($stmt->execute()) {
            $success_msg = "Registration successful! You can now log in.";
            // Redirect to the login page after successful registration
            header("Location: login.php");
            exit();
        } else {
            echo "Something went wrong. Please try again later.";
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Jewellers Store</title>
    <link rel="stylesheet" href="styles.css"> <!-- Ensure this path is correct -->
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="categories.php">Categories</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="register.php">Register</a></li>
                <li><a href="login.php">Login</a></li>
                
            </ul>
        </nav>
    </header>

    <main>
        <h1>Register</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>">
                <span class="error"><?php echo $name_err; ?></span>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
                <span class="error"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password">
                <span class="error"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Conform Password</label>
                <input type="password" name="cpassword">
                <span class="error"><?php echo $password_err; ?></span>
            </div>
            <div>
                <button type="submit">Register</button>
            </div>
            <div>
                <span class="success"><?php echo $success_msg; ?></span>
            </div>
        </form>
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
