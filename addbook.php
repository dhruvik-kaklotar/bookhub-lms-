<?php
include 'header.php';
if (!isset($_SESSION['loggedin'])) {
    // Redirect to the login page
    header("location: admin login.php");
    exit;
}
?>

<?php
// Database connection assumed to be established earlier
// Fetch categories from the database
$query = "SELECT Categorie_name FROM newcategorie";
$res = mysqli_query($conn, $query);

// Fetch categories into an array
$categories = array();
while ($row = mysqli_fetch_assoc($res)) {
    $categories[] = $row['Categorie_name'];
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $categories = $_POST['categories'];
    $price = $_POST['price'];
    $authorname = $_POST['authorname'];
    $date = $_POST['date'];

    $targetDir = "bimg/";
    $fileName = basename($_FILES["img"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Check if file is a valid image
    $allowTypes = array('jpg', 'jpeg', 'png', 'gif');
    if (in_array($fileType, $allowTypes)) {
        // Upload image file to server
        if (move_uploaded_file($_FILES["img"]["tmp_name"], $targetFilePath)) {
            // File uploaded successfully, proceed to insert data into database
            $pdfDir = "bimg/";
            $pdfName = basename($_FILES["pdf"]["name"]);
            $pdfFilePath = $pdfDir . $pdfName;
            $pdfFileType = pathinfo($pdfFilePath, PATHINFO_EXTENSION);

            // Check if file is a valid PDF
            if ($pdfFileType === 'pdf') {
                // Upload PDF file to server
                if (move_uploaded_file($_FILES["pdf"]["tmp_name"], $pdfFilePath)) {
                    // Insert image and PDF file names into the database
                    $query = "INSERT INTO books (name, categories, img, pdf, price, authorname, date) VALUES ('$name', '$categories', '$fileName', '$pdfName', $price, '$authorname', '$date')";
                    if (mysqli_query($conn, $query)) {
                    } else {
                        echo "Error inserting record: " . mysqli_error($conn);
                    }
                } else {
                    echo "Sorry, there was an error uploading your PDF file.";
                }
            } else {
                echo "Sorry, only PDF files are allowed.";
            }
        } else {
            echo "Sorry, there was an error uploading your image file.";
        }
    } else {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    }
}

mysqli_close($conn);
?>

<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Add book</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="adashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Add book</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-success">
              <div class="card-header">
               <center> <h3 class="card-title">Add new book</h3></center>
             
              </div>
            <div class="card shadow">
                <div class="card-body">
                    <form action="addbook.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" name="name" class="form-control" id="name" required>
                        </div>


                        <div class="mb-3">
                            <label for="categories" class="form-label">Categories:</label>
                            <select name="categories" class="form-control" id="categories" required>
                                <option value="">Select Category</option>
                                <?php foreach ($categories as $category): ?>
                                <option value="<?php echo $category; ?>"><?php echo $category; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>


                        <div class="mb-3">
                            <label for="img" class="form-label">Image:</label>
                            <input type="file" name="img" class="form-control" id="img" required>
                        </div>
                        <div class="mb-3">
    <label for="pdf" class="form-label">PDF:</label>
    <input type="file" name="pdf" class="form-control" id="pdf" required accept=".pdf">
</div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price:</label>
                            <input type="text" name="price" class="form-control" id="price" required>
                        </div>
                        <div class="mb-3">
                            <label for="authorname" class="form-label">Author Name:</label>
                            <input type="text" name="authorname" class="form-control" id="authorname" required>
                        </div>
                        <div class="mb-3">
                            <label for="date" class="form-label">Date:</label>
                            <input type="date" name="date" class="form-control" id="date" required>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    
    $(document).ready(function() {
        $("input, select").on("input", function() {
            var isValid = this.checkValidity();
            $(this).removeClass("is-valid is-invalid");
            if (isValid) {
                $(this).addClass("is-valid");
            } else {
                if (this.value.trim() === "") {
                    $(this).removeClass("is-invalid");
                } else {
                    $(this).addClass("is-invalid");
                }
            }
        });


        // Trigger input event to apply validation classes when data is filled in the form
        $("input, select").trigger("input");
    });
</script>
