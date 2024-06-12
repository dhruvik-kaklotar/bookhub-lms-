<?php
session_start();
include 'header.php';
if (!isset($_SESSION['sloggedin'])) {
    // Redirect to the login page
    header("location: slogin.php");
    exit;
}

date_default_timezone_set("Asia/Calcutta");

$studname = $_SESSION['sloggedin'];

// Fetch data from the 'reg_student' table for the logged-in student
$sql = "SELECT * FROM reg_student WHERE lid='$studname'";
$result = $conn->query($sql);

// Check if any rows were returned
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        // Store fetched data into variables
        $studentname = $row["name"];
        $lid = $row["lid"];
        $address = $row["address"];
        $contact = $row["phone"];
        $email = $row["email"];
    }
} else {
    echo "0 results";
}

$paymentid = $_POST['payment_id'];
$productid = $_POST['product_id'];

$sql = "SELECT * FROM books WHERE bookid='$productid'";
$result = $conn->query($sql);

// Check if any rows were returned
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        // Store fetched data into variables
        $bookname = $row["name"];
		$author =$row["authorname"];
		$price =$row["price"];
    }
} else {
    echo "0 results";
}

$dt = date('Y-m-d h:i:s');

$sql = "INSERT INTO orders (product_id, payment_id, date, studentname, lid, address, contact, email, bookname,author,price) 
        VALUES ('$productid', '$paymentid', '$dt', '$studentname', '$lid', '$address', '$contact', '$email', '$bookname', '$author', '$price')";

if (mysqli_query($conn, $sql)) {
    echo 'done';
    $_SESSION['paymentid'] = $paymentid;
} else {
    header("Location:index.php");
exit;
}

?>
