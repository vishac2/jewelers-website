<?php
// Initialize variables
$name = $email = $message = "";
$name_err = $email_err = $message_err = "";
$success_msg = "";

// Handle form submission
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
        $email = trim($_POST["email"]);
    }

    if (empty(trim($_POST["message"]))) {
        $message_err = "Please enter your message.";
    } else {
        $message = trim($_POST["message"]);
    }

    // Process the contact form if no errors
    if (empty($name_err) && empty($email_err) && empty($message_err)) {
        // Here you could send the email or store the message in a database
        // For this example, we'll just display a success message
        $success_msg = "Your message has been sent successfully!";
        // Clear the form fields
        $name = $email = $message = "";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Jewellers Store</title>
    <link rel="stylesheet" href="styles.css">
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
        <h1>Contact Us</h1>
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
                <label>Message</label>
                <textarea name="message" rows="5"><?php echo htmlspecialchars($message); ?></textarea>
                <span class="error"><?php echo $message_err; ?></span>
            </div>
            <div>
                <button type="submit">Send Message</button>
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
