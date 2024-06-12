<?php 
include 'header.php';

// Check if the user is logged in
if (!isset($_SESSION['sloggedin'])) {
    // Redirect to the login page
    header("location: slogin.php");
    exit;
}

// Retrieve the logged-in student's ID
$student_id = $_SESSION['sloggedin'];

// SQL query to check if the student has purchased any book
$sql = "SELECT o.order_id, b.name AS bookname, b.authorname AS author, b.price, o.date, b.pdf
        FROM orders o
        INNER JOIN books b ON o.order_id = b.bookid
        WHERE o.lid = '$student_id'";

// Execute the query
$result = mysqli_query($conn, $sql);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books Purchased</title>
    <link rel="stylesheet" href="styles.css"> <!-- assuming styles.css contains your CSS styles -->
</head>
<body>
    <div class="container">
        <?php if (mysqli_num_rows($result) > 0): ?>
            <h2>Books Purchased:</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Book Name</th>
                        <th>Author</th>
                        <th>Price</th>
                        <th>Date</th>
                        <th>Download PDF</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo $row['order_id']; ?></td>
                            <td><?php echo $row['bookname']; ?></td>
                            <td><?php echo $row['author']; ?></td>
                            <td>₹<?php echo $row['price']; ?></td>
                            <td><?php echo $row['date']; ?></td>
                            <td><a href="../bimg/<?php echo $row['pdf']; ?>" class="btn btn-primary" download>Download</a></td> <!-- Download button -->
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No books purchased yet.</p>
        <?php endif; ?>
    </div>
</body>
</html>

<?php
// Close the database connection

?>
