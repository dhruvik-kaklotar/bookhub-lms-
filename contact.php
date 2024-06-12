<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Contact Us</title>
<link rel="stylesheet" href="index.css">
<style>
  /* General Styles */
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
  }
  .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
  }
  h2 {
    color: #009688;
  }
  /* Contact Details Styles */
  .contact-details {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
  }
  .contact-info {
    flex: 1;
    padding: 20px;
    background-color: #f4f4f4;
    border-radius: 10px;
  }
  .contact-info h3 {
    margin-top: 0;
  }
  .contact-info p {
    margin: 10px 0;
  }
  /* Map Styles */
  .map {
    width: 100%;
    border-radius: 10px;
    margin-bottom: 30px;
    text-align : end;
}
  /* Contact Form Styles */
  .contact-form {
    background-color: #f4f4f4;
    padding: 20px;
    border-radius: 10px;
  }
  .contact-form label {
    font-weight: bold;
  }
  .contact-form input[type="text"],
  .contact-form input[type="email"],
  .contact-form textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
    box-sizing: border-box;
  }
  .contact-form textarea {
    height: 100px;
  }
  .contact-form input[type="submit"] {
    background-color: #009688;
    color: #fff;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    border-radius: 5px;
  }
  .contact-form input[type="submit"]:hover {
    background-color: #00796b;
  }
</style>
</head>
<body>
<header>
        <div class="container">
            <div class="navbar">
                <div class="logo">
                    <img src="logo.png" alt="" />
                </div>
                <nav>
                    <div class="btn">
                        <i class="fa fa-times close-btn"></i>
                    </div>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="admin%20login.php">Admin Panel</a></li>
                    <li><a href="faculty/flogin.php">Staff Panel</a></li>
                    <li><a href="student/slogin.php">Student Panel</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </nav>
                <div class="btn">
                    <i class="fa fa-bars menu-btn"></i>
                </div>
            </div>
        </div>
    </header>
<div class="container">
  <h2>Contact Us</h2>

  <!-- Contact Details and Map Section -->
  <div class="contact-details">
    <div class="contact-info">
      <h3>Our Location</h3>
      <p>123 Main Street<br>City, State ZIP<br>Country</p>
      <h3>Contact Information</h3>
      <p>Email: info@example.com<br>Phone: +1 234 567 890</p>
    </div>
    <div class="map">
      <!-- Replace the src attribute with your map embed code or API -->
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3252.481715105805!2d-122.08203778467486!3d37.40204597981782!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808f7f843458bb4b%3A0x94459430e3e54b12!2sGolden%20Gate%20Bridge!5e0!3m2!1sen!2sus!4v1635776944592!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
  </div>

  <!-- Contact Form Section -->
  <div class="contact-form">
    <h3>Send us a message</h3>
    <form action="process_contact.php" method="post">
      <label for="name">Name</label><br>
      <input type="text" id="name" name="name" required><br>

      <label for="email">Email</label><br>
      <input type="email" id="email" name="email" required><br>

      <label for="message">Message</label><br>
      <textarea id="message" name="message" required></textarea><br>

      <input type="submit" value="Submit">
    </form>
  </div>
</div>

</body>
</html>
