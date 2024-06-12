<?php 
include 'header.php';
if (!isset($_SESSION['sloggedin'])) {
    // Redirect to the login page
    header("location: admin login.php");
    exit;
}

$slogin = $_SESSION['sloggedin'];

$sql = "SELECT name, lid, email FROM reg_student WHERE lid = '$slogin'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $name = $row['name'];
        $lid = $row['lid'];
        $email = $row['email'];
    }
} else {
    echo "0 results";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_name = $_POST['student_name'];
    $lid = $_POST['lid'];
    $email = $_POST['email'];
    $book_name = $_POST['book_name'];
    $author_name = $_POST['author_name'];
    $url = $_POST['url'];

    $sql = "INSERT INTO book_requests (student_name, lid, email, book_name, author_name, book_url) VALUES ('$student_name', '$lid', '$email', '$book_name', '$author_name', '$url')";

    if (mysqli_query($conn, $sql)) {
        echo "Request submitted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>

<style>
    /* Additional custom styles */
    body {
        background-color: #f8f9fa;
    }
    .container {
        max-width: 500px;
        margin: 100px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .btn-primary:hover {
        background-color: #28a745;
        border-color: #28a745;
    }
</style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4">Book Request Form</h2>
        <form method="POST" action="bookrequest.php" id="bookRequestForm">
            <div class="form-group">
                <label for="student_name">Student Name:</label>
                <input type="text" id="student_name" name="student_name" class="form-control" value="<?php echo isset($name) ? $name : ''; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="lid">LID:</label>
                <input type="text" id="lid" name="lid" class="form-control" value="<?php echo isset($lid) ? $lid : ''; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" value="<?php echo isset($email) ? $email : ''; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="book_name">Book Name:</label>
                <input type="text" id="book_name" name="book_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="author_name">Author Name:</label>
                <input type="text" id="author_name" name="author_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="url">URL:</label>
                <input type="text" id="url" name="url" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
