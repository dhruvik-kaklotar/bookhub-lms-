<?php 
include 'header.php';

// Check if the user is logged in
if (!isset($_SESSION['sloggedin'])) {
    // Redirect to the login page if not logged in
    header("location: slogin.php");
    exit;
} 

// Check if the required GET parameters are set
if (!isset($_GET['bookid']) || !isset($_GET['name']) || !isset($_GET['categories']) || !isset($_GET['img']) || !isset($_GET['price']) || !isset($_GET['authorname'])) {
    // Handle the case when the required GET parameters are missing
    echo "Missing required parameters";
    exit;
}

// Get the values from the GET parameters
$id = $_GET['bookid'];
$name = $_GET['name'];
$categories = $_GET['categories'];
$img = $_GET['img'];
$price = $_GET['price'];    
$authorname = $_GET['authorname'];

// Fetch book details from the database
$ret = mysqli_query($conn, "SELECT * FROM books WHERE bookid=$id");
if (!$ret) {
    // Handle the case when there's an error in the SQL query
    die('Error in SQL query: ' . mysqli_error($conn));
}

// Fetch student details from the database
$ret1 = mysqli_query($conn, "SELECT * FROM reg_student WHERE lid={$_SESSION['sloggedin']}");
if (!$ret1) {
    // Handle the case when there's an error in the SQL query
    die('Error in SQL query: ' . mysqli_error($conn));
}

// Check if the student details are found
if (mysqli_num_rows($ret1) > 0) {
    // Fetch the student details
    $student_row = mysqli_fetch_assoc($ret1);

    // Assign student details to variables
    $student_name = $student_row['name'];
    $student_email = $student_row['email'];
    $student_phone = $student_row['phone'];
    $student_address = $student_row['address'];
}
?>

<section class="checkout-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12" style="margin-top: 80px;">
                <div class="row">
                    <!-- Display product details -->
                    <?php while ($row = mysqli_fetch_array($ret)) { ?>
                    <div class="col-lg-5 mb-4">
                        <div class="card">
                            <img src="bimg/<?php echo $row['img'] ?>" alt="product" class="card-img-top">
                            <div class="card-body" >
                                <h5 class="card-title">Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;       :&nbsp; <?php echo $row['name']; ?></h5><br>
                                <p class="card-text">  Categories  : <?php echo $row['categories']; ?></p>
                                <p class="card-text">  Author Name : &nbsp;<?php echo $row['authorname']; ?></p>
                                <p class="card-text" style="color: hotpink;">Price: <?php echo $row['price']; ?></p>
                            </div>
                        </div>
                    </div>
                    <!-- Buy Now Button -->
                    <div class="col-lg-7">
                        <fieldset style="border: 2px solid #000; padding: 20px;">
                            <center><label style="font-size: 50px; text-align:center">Place Order</label></center>
                            <hr>
                            <form action="" method="post" style="height: 350px;"><br><br>
                                <input type="hidden" name="product_id" value="<?php echo $row['bookid']; ?>">
                                <input type="hidden" name="product_name" value="<?php echo $row['name']; ?>">
                                <input type="hidden" name="product_amount" value="<?php echo $row['price']; ?>">
                                <div class="form-group">
                                    <label for="name">Full Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required value="<?php echo isset($student_name) ? $student_name : ''; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required value="<?php echo isset($student_email) ? $student_email : ''; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" required value="<?php echo isset($student_phone) ? $student_phone : ''; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" required value="<?php echo isset($student_address) ? htmlspecialchars($student_address) : ''; ?>">
                                </div>
                                <button type="submit" class="btn btn-primary buynow" 
                        data-productid="<?php echo $row['bookid']; ?>"
                        data-productname="<?php echo $row['name']; ?>"
                        data-amount="<?php echo $row['price']; ?>">Pay Now</button>
                <button type="button" class="btn btn-secondary ml-2">Home</button>
                <!-- onclick="location.href='index.php' -->
                            </form>
                        </fieldset>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- Include JavaScript files -->
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
$(".buynow").click(function(event) {
    console.log("Buy Now button clicked!");
    var amount = $(this).attr('data-amount');
    var productid = $(this).attr('data-productid');
    var productname = $(this).attr('data-productname');

    var options = {
        "key": "rzp_test_KOEl3joQDCrscD", // Enter the Key ID generated from the Dashboard
        "amount": amount * 100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
        "name": "BookHub Manager",
        "description": productname,
        "image": "https://example.com/your_logo",
        "handler": function(response) {
            var paymentid = response.razorpay_payment_id;

            $.ajax({
                url: "payment-process.php",
                type: "POST",
                data: { product_id: productid, payment_id: paymentid },
                success: function(finalresponse) {
                    if (finalresponse == 'done') {
                        window.location.href = "http://localhost/php-practical-work/payment-gateway/razorpay/success.php";
                    } else {
                        // header("Location:purchesdbook.php");
                    //exit;
                       alert('Book Purchase Successfully');
                       window.location.href = "purchesdbook.php";
                    }
                }
            })
        },
        "theme": {
            "color": "#3399cc"
        }
    };
    var rzp1 = new Razorpay(options);
    rzp1.open();
    event.preventDefault();
});
</script>