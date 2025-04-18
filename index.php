<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jewellers Website</title>
    <link rel="stylesheet" href="style.css">
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

    <div class="background-slider">
        <div class="slide" style="background-image: url('images/bg1.jpg');"></div>
        <div class="slide" style="background-image: url('images/bg2.jpg');"></div>
        <div class="slide" style="background-image: url('images/bg3.jpg');"></div>
    </div>

   
    <script>
        let index = 0;
        const slides = document.querySelectorAll('.slide');

        function showNextSlide() {
            slides[index].classList.remove('active');
            index = (index + 1) % slides.length;
            slides[index].classList.add('active');
        }

        setInterval(showNextSlide, 3000); // Change slide every 3 seconds
    </script>
    <main>
        <section id="about">
            <h1>About Us</h1>
            <p>Welcome to Kothari Jewellers, where elegance meets craftsmanship. Established in 2002, we have been dedicated to creating exquisite jewellery that tells a story. Our passion for fine details and high-quality materials sets us apart in the jewellery industry.</p>

            <h2>Our Mission</h2>
            <p>At Kothari Jewellers, our mission is to provide our customers with stunning pieces that enhance their beauty and reflect their individuality. We believe that jewellery is not just an accessory; it's an expression of who you are.</p>

            <h2>Our Values</h2>
            <ul>
                <li><strong>Quality:</strong> We source the finest materials to ensure that each piece is made to last.</li>
                <li><strong>Craftsmanship:</strong> Our skilled artisans meticulously craft every item with care and precision.</li>
                <li><strong>Customer Satisfaction:</strong> We prioritize our customers' happiness and work tirelessly to meet their needs.</li>
            </ul>

            <h2>Our Journey</h2>
            <p>From our humble beginnings to becoming a trusted name in the jewellery world, our journey has been fueled by passion and dedication. We take pride in our craftsmanship and aim to exceed our customers' expectations with every piece.</p>

            <h2>Visit Us</h2>
            <p>We invite you to explore our collections and find the perfect piece that resonates with you. Visit our store or browse online to discover the beauty of our creations.</p>
        </section>
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
