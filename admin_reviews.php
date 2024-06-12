<?php
include 'header.php'; // Include your header file
include 'inc/config.php'; // Include your database connection file

// Fetch all books
$sql_books = "SELECT * FROM books";
$result_books = $conn->query($sql_books);

// Fetch reviews for each book
$reviews_by_book = array();
if ($result_books->num_rows > 0) {
    while($row_book = $result_books->fetch_assoc()) {
        $book_id = $row_book['bookid'];
        $book_name = $row_book['name'];

        // Fetch reviews for this book
        $sql_reviews = "SELECT * FROM book_reviews WHERE book_id = '$book_id'";
        $result_reviews = $conn->query($sql_reviews);

        // Store reviews in an array
        $reviews = array();
        if ($result_reviews->num_rows > 0) {
            while($row_review = $result_reviews->fetch_assoc()) {
                $reviews[] = $row_review;
            }
        }

        // Store reviews for this book
        $reviews_by_book[$book_name] = $reviews;
    }
}
?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Reviews by Book</h3>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($reviews_by_book)): ?>
                            <?php foreach ($reviews_by_book as $book_name => $reviews): ?>
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" onclick="toggleReviews('collapse_<?php echo str_replace(' ', '_', $book_name); ?>')"><?php echo $book_name; ?></button>
                                        </h5>
                                    </div>
                                    <div id="collapse_<?php echo str_replace(' ', '_', $book_name); ?>" class="collapse">
                                        <div class="card-body">
                                            <?php if (!empty($reviews)): ?>
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Reviewer</th>
                                                            <th>Rating</th>
                                                            <th>Review</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($reviews as $review): ?>
                                                            <tr>
                                                                <td><?php echo $review['reviewer_name']; ?></td>
                                                                <td><?php echo $review['rating']; ?></td>
                                                                <td><?php echo $review['review_text']; ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            <?php else: ?>
                                                <p>No reviews for this book.</p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>No books available.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function toggleReviews(id) {
    var x = document.getElementById(id);
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}
</script>
