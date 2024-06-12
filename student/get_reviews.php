<?php
include 'config.php'; // Include your database connection script

$bookId = $_POST['book_id'];

// Fetch reviews for the given book
$sql = "SELECT * FROM book_reviews WHERE book_id = '$bookId'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<p><strong>Reviewer:</strong> " . $row['reviewer_name'] . "</p>";
        echo "<p><strong>Rating:</strong> " . $row['rating'] . " Stars</p>";
        echo "<p><strong>Review:</strong> " . $row['review_text'] . "</p><hr>";
    }
} else {
    echo "No reviews available for this book.";
}

$conn->close();
?>
