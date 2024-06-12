<?php
include 'header.php';
if (!isset($_SESSION['loggedin'])) {
    // Redirect to the login page
    header("location: admin login.php");
    exit;
}

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Delete record
if(isset($_POST['delete'])){
    $bookid = $_POST['delete'];
    $sql = "DELETE FROM books WHERE bookid='$bookid'";
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Update record
if(isset($_POST['update'])){
    $bookid = $_POST['bookid'];
    $name = $_POST['name'];
    $categories = $_POST['categories'];
    $price=$_POST['price'];
    $authorname=$_POST['authorname'];
    $date=$_POST['date'];

    $targetDir = "bimg/";
    $fileName = basename($_FILES["img"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Check if file is a valid image
    $allowTypes = array('jpg', 'jpeg', 'png', 'gif');
    if (in_array($fileType, $allowTypes)) {
        // Upload file to server
        if (move_uploaded_file($_FILES["img"]["tmp_name"], $targetFilePath)) {
            // Insert image file name into database
            $sql = "UPDATE books SET name='$name', categories='$categories', img='$fileName', price='$price', authorname='$authorname', date='$date' WHERE bookid='$bookid'";
            if ($conn->query($sql) === TRUE) {
                echo "Record updated successfully";
            } else {
                echo "Error updating record: " . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    }
}

// Fetch data from books table
$sql = "SELECT * FROM books";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Books</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><b>All Books</b></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="adashboard.php">Home</a></li>
                    <li class="breadcrumb-item active">All books</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="input-group input-group-sm mb-3">
        <input type="text" id="searchInput" class="form-control form-control-sm" onkeyup="searchTable()" placeholder="Search for Book...">
        <div class="input-group-append">
            <span class="input-group-text"><i class="fa fa-search"></i></span>
        </div>
    </div>

    <div class="card">
        <div class="card-header text-center">
            <h3 class="card-title" style="color: #333;">All books</h3>
        </div>
        <div class="card-body p-0">
            <table class="table table-sm mx-auto" id="issueTable">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Categories</th>
                        <th>Price</th>
                        <th>Author Name</th>
                        <th>Date</th>
                        <th>Action</th>
                        <th>Download PDF</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td><img src='./bimg/" . $row["img"] . "' height='100' width='100' alt=''></td>";
                            echo "<td>" . $row["bookid"] . "</td>";
                            echo "<td>" . $row["name"] . "</td>";
                            echo "<td>" . $row["categories"] . "</td>";
                            echo "<td>" . $row["price"] . "</td>";
                            echo "<td>" . $row["authorname"] . "</td>";
                            echo "<td>" . $row["date"] . "</td>";
                            echo "<td>
                                    <form method='post'>
                                        <button type='button' class='btn btn-primary edit-btn' data-toggle='modal' data-target='#editModal'
                                            data-bookid='" . $row["bookid"] . "'
                                            data-name='" . $row["name"] . "'
                                            data-categories='" . $row["categories"] . "'
                                        >Edit</button>
                                        <input type='hidden' name='delete' value='" . $row["bookid"] . "'>
                                        <button type='submit' class='btn btn-danger'>Delete</button>
                                    </form>
                                </td>";
                                echo "<td><a href='./bimg/" . $row["pdf"] . "' class='btn btn-primary' download>Download</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8'>0 results</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="editModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Book</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="edit-name">Name:</label>
                        <input type="text" class="form-control" id="edit-name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="edit-categories">Categories:</label>
                        <input type="text" class="form-control" id="edit-categories" name="categories">
                    </div>
                    <div class="mb-3">
                        <label for="img" class="form-label">Image:</label>
                        <input type="file" name="img" class="form-control" id="img" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-price">Price:</label>
                        <input type="text" class="form-control" id="edit-price" name="price">
                    </div>
                    <div class="form-group">
                        <label for="edit-authorname">Author Name:</label>
                        <input type="text" class="form-control" id="edit-authorname" name="authorname">
                    </div>
                    <div class="form-group">
                        <label for="edit-date">Date:</label>
                        <input type="date" class="form-control" id="edit-date" name="date">
                    </div>
                    <input type="hidden" id="edit-bookid" name="bookid">
                    <button type="submit" name="update" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function(){
        $('.edit-btn').click(function(){
            var bookid = $(this).data('bookid');
            var name = $(this).data('name');
            var categories = $(this).data('categories');
            var img = $(this).closest('tr').find('img').attr('src').replace('./bimg/', ''); // Get the image filename from the src attribute
            var price = $(this).closest('tr').find('td:eq(4)').text(); // Get the price from the 5th column (index 4)
            var authorname = $(this).closest('tr').find('td:eq(5)').text(); // Get the author name from the 6th column (index 5)
            var date = $(this).closest('tr').find('td:eq(6)').text(); // Get the date from the 7th column (index 6)

            $('#edit-bookid').val(bookid);
            $('#edit-name').val(name);
            $('#edit-categories').val(categories);
            $('#edit-img').val(img); // Set the value of the hidden input field for the image
            $('#edit-price').val(price);
            $('#edit-authorname').val(authorname);
            $('#edit-date').val(date);
        });
    });

    function searchTable() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("issueTable");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1]; // Index of the "Id" column
            tdCategories = tr[i].getElementsByTagName("td")[3]; // Index of the "Categories" column
            if (td || tdCategories) {
                txtValue = td.textContent || td.innerText;
                txtCategories = tdCategories.textContent || tdCategories.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1 || txtCategories.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>

</body>
</html>
