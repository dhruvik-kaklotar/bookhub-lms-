<?php
// Database connection
$servername = "localhost:3307"; // Change to your database server name
$username = "root"; // Change to your database username
$password = ""; // Change to your database password
$dbname = "bookhub__2_"; // Change to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Fetch books from the database
$sql = "SELECT name, categories, img, price, authorname FROM books";
$result = $conn->query($sql);

// Close database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <title>BookHub Manager</title>
    <link rel="stylesheet" href="index.css">
    <!-- Plugin-CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/icofont.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/cardslider.css">
    <link rel="stylesheet" href="css/responsiveslides.css">

     <!-- Main-Stylesheets -->
     <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/overright.css">
    <link rel="stylesheet" href="css/theme.css">
   
    <link rel="stylesheet" href="css/responsive.css">
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body data-spy="scroll" data-target="#mainmenu" data-offset="50">
<div class="mainmenu-area navbar-fixed-top" data-spy="affix" data-offset-top="10">
            <nav class="navbar">
                <div class="container">
                    <div class="navbar-header">
                        <div class="space-10"></div>
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mainmenu">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <!--Logo-->
                        <a href="#sc1" class="navbar-left show"><img src="book.png" alt="library" height="50px"> </a>
                        <div class="space-10"></div>
                    </div>
                    <!--Toggle-button-->

                    <!--Mainmenu list-->
                    <div class="navbar-right in fade" id="mainmenu">
                        <ul class="nav navbar-nav nav-white text-uppercase">
                            <li class="active">
                                <a href="#sc1">Home</a>
                            </li>
                            <li>
                                <a href="books.php">Books</a>
                            </li>
                            <li>
                                <a href="admin login.php">Library User Login</a>
                            </li>
                            <li>
                                <a href="student/slogin.php">Staff Login</a>
                            </li>
                            <li>
                                <a href="faculty/flogin.php">Admin Login</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            </div></div></div></div></div></div>    
   
    <section>
        <video autoplay muted loop>
            <source src="bg_liabray.mp4" type="video/mp4" />
        </video>
        <div class="container">
            <div class="content">
                <h2>Explore, Imagine, </h2>
                <h2>Learn: Your Gateway</h2>
                <h2> to Knowledge</h2>
                <p>
                    Education is the key to success. Start your journey with us and let knowledge be your guide.
                </p>
                <button><a href="contact.php">Explore More</a></button>
            </div>
        </div>
    </section>
    <section class="services">
        <div class="container">
            <h2>Our Services</h2>
            <div class="service-items">
                <div class="service-item">
                    <i class="fas fa-book"></i>
                    <h3>Wide Collection of Books</h3>
                    <p>Explore our vast collection of books spanning various genres, from classics to contemporary
                        bestsellers.</p>
                </div>
                <div class="service-item">
                    <i class="fas fa-laptop"></i>
                    <h3>Online Catalog</h3>
                    <p>Access our library catalog online from anywhere, anytime, and easily search for your favorite
                        titles.</p>
                </div>
                <div class="service-item">
                    <i class="fas fa-users"></i>
                    <h3>Community Events</h3>
                    <p>Participate in our community events, book clubs, and workshops to connect with fellow book
                        lovers.</p>
                </div>
                <div class="service-item">
                    <i class="fas fa-clock"></i>
                    <h3>Extended Hours</h3>
                    <p>We offer extended opening hours, ensuring you have ample time to indulge in your reading habits.
                    </p>
                </div>
            </div>
        </div>
    </section>
   
    <footer>
  <div class="footer-content">
    <span class="footer-logo">BookHub Manager</span>
  </div>
</footer>
    <script src="js/script.js"></script>
</body>

</html>


<script>
let menu = document.querySelector('nav');
let menuBtn = document.querySelector('.menu-btn');
let closeBtn = document.querySelector('.close-btn');

menuBtn.addEventListener('click', function() {
    menu.classList.add('active');
})
closeBtn.addEventListener('click', function() {
    menu.classList.remove('active');
})
</script>