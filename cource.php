<?php
include 'inc/config.php';
include 'header.php';
if (!isset($_SESSION['loggedin'])) {
    // Redirect to the login page
    header("location: admin login.php");
    exit;
}

// Assuming you've already established a database connection

if(isset($_POST['submit'])) {
    // Retrieve other form data
    $courcename = $_POST['courcename'];
    $description = $_POST['description'];
    $duration = $_POST['duration'];
    $fee = $_POST['fee'];
    $date = $_POST['date'];
    $faculty = $_POST['faculty'];

    // Handle file upload
    $target_dir = "bimg/"; // Directory where uploaded files will be saved
    $target_file = $target_dir . basename($_FILES["img"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["img"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
           

            // Insert data into the course table
            $sql = "INSERT INTO course (courcename, description, duration, fee, img, date, faculty) 
                    VALUES ('$courcename', '$description', '$duration', '$fee', '$target_file', '$date', '$faculty')";

            if(mysqli_query($conn, $sql)) {
                echo "Record inserted successfully.";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>

<div>  
 <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><b>Add Course</b></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="adashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Add Course</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    </div>
   
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Course</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-info">
                <div class="card-header">
                    <h2 class="text-center">Add Course</h2>
                </div>
                <div class="card-body">
                    <form action="cource.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="courcename">Course Name:</label>
                            <input type="text" class="form-control" id="courcename" name="courcename" required>
                        </div>
                        <div class="form-group">
                            <label for="img">Image:</label>
                            <input type="file" class="form-control-file" id="img" name="img">
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea class="form-control" id="description" name="description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="duration">Duration:</label>
                            <input type="text" class="form-control" id="duration" name="duration">
                        </div>
                        <div class="form-group">
                            <label for="fee">Fee:</label>
                            <input type="text" class="form-control" id="fee" name="fee">
                        </div>
                        <div class="form-group">
                            <label for="date">Start Date:</label>
                            <input type="date" class="form-control" id="date" name="date">
                        </div>
                        <div class="form-group">
                            <label for="faculty">Faculty:</label>
                            <input type="text" class="form-control" id="faculty" name="faculty">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
