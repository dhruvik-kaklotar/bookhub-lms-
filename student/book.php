<?php 
include 'header.php';
if (!isset($_SESSION['sloggedin'])) {
    // Redirect to the login page
    header("location: slogin.php");
    exit;
} 

// Fetch data from books table
$sql = "SELECT * FROM books";
$result = $conn->query($sql);
?>
 <script>
    function searchTable() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.querySelector(".table");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[2]; // Index of the "Name" column
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>

<section class="content" style="background-image: url('2.jpg'); background-attachment: fixed; background-size: cover;">
    <div class="container-fluid">
        <div><h1>&nbsp;</h1></div>
        <div class="input-group input-group-sm mb-3">
            <input type="text" id="searchInput" class="form-control form-control-sm" onkeyup="searchTable()" placeholder="Search for Book...">
            <div class="input-group-append">
                <span class="input-group-text"><i class="fa fa-search"></i></span>
            </div>
        </div>

        <div class="row">
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
            ?>
            <div class="col-md-3">
                <div class="card mb-3" style="width:220px;">
                    <div class="card-body" style="height: 260px;">
                        <img class="card-img-top" src="../bimg/<?php echo $row['img']; ?>" alt="Book Image" style="width: 180px; height:220px">
                    </div>
                    <div class="card-footer">
                        <p class="card-text">Book Id: <?php echo $row['bookid']; ?></p> 
                        <p class="card-text">Name: <?php echo $row['name']; ?></p>
                        <p class="card-text">Price: <?php echo $row['price']; ?></p> 
                        
                        <button type="button" class="btn btn-success"><a href="checkout.php?bookid=<?php echo $row['bookid']; ?>&name=<?php echo urlencode($row['name']); ?>&categories=<?php echo urlencode($row['categories']); ?>&img=<?php echo $row['img']; ?>&price=<?php echo $row['price']; ?>&authorname=<?php echo $row['authorname']; ?>" style="color: #ffff;">Purchase</a></button>
                        <!-- Show Reviews Button -->
                        <br>
                        <br>
                        <button type="button" class="btn btn-info show-reviews" data-book-id="<?php echo $row['bookid']; ?>">Show Reviews</button>
                        <!-- Add Review Button (Opens Modal) -->
                        <br>
                        <br>
                        <button type="button" class="btn btn-primary add-review" data-toggle="modal" data-target="#reviewModal" data-book-id="<?php echo $row['bookid']; ?>">Add Review</button>
                    </div>
                </div>
            </div>
            <?php
                }
            } else {
                echo "<div class='col-md-12'><p class='text-center'>No books available.</p></div>";
            }
            ?>
        </div>
    </div>
</section>

<!-- Modal to Show Reviews -->
<div class="modal fade" id="reviewsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reviews</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="reviewList">
                <!-- Reviews will be loaded here using AJAX -->
            </div>
        </div>
    </div>
</div>

<!-- Modal to Add Review -->
<div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Review</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Review Form -->
                <form id="addReviewForm">
                    <input type="hidden" id="bookId" name="book_id">
                    <div class="form-group">
                        <label for="reviewerName">Your Name:</label>
                        <input type="text" class="form-control" id="reviewerName" name="reviewer_name" required>
                    </div>
                    <div class="form-group">
                        <label for="reviewText">Review:</label>
                        <textarea class="form-control" id="reviewText" name="review_text" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="rating">Rating:</label>
                        <select class="form-control" id="rating" name="rating">
                            <option value="1">1 Star</option>
                            <option value="2">2 Stars</option>
                            <option value="3">3 Stars</option>
                            <option value="4">4 Stars</option>
                            <option value="5">5 Stars</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Review</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Function to handle showing reviews
$(document).on("click", ".show-reviews", function () {
    var bookId = $(this).data('book-id');
    $.ajax({
        type: 'POST',
        url: 'get_reviews.php',
        data: { book_id: bookId },
        success: function (data) {
            $('#reviewList').html(data);
            $('#reviewsModal').modal('show');
        }
    });
});

// Function to handle adding review
$(document).on("click", ".add-review", function () {
    var bookId = $(this).data('book-id');
    $('#bookId').val(bookId);
});

// Submit review form
$('#addReviewForm').submit(function (e) {
    e.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
        type: 'POST',
        url: 'submit_review.php',
        data: formData,
        success: function (response) {
            alert(response);
            $('#reviewModal').modal('hide');
        }
    });
});
</script>