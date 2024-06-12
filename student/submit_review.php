<?php
include 'config.php'; // Include your database connection script

// Get form data
$bookId = $_POST['book_id'];
$reviewerName = $_POST['reviewer_name'];
$reviewText = $_POST['review_text'];
$rating = $_POST['rating'];

// Insert into reviews table
$sql = "INSERT INTO book_reviews (book_id, reviewer_name, review_text, rating) VALUES ('$bookId', '$reviewerName', '$reviewText', '$rating')";
if ($conn->query($sql) === TRUE) {
    echo "Review submitted successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
