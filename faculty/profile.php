<?php

include 'header.php';

// Check if the user is logged in
if (!isset($_SESSION['floggedin'])) {
    header("Location: flogin.php");
    exit;
}

// Fetch user information based on username
$username = $_SESSION['floggedin'];
$sql = "SELECT * FROM faculty WHERE fid=$_SESSION[floggedin]";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

// Handle form submission for updating user information
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];

    // Handle file upload
    $photo = $_FILES["photo"]["name"];
    $temp_name = $_FILES["photo"]["tmp_name"];
    $target_dir = "bimg/";
    $target_file = $target_dir . basename($photo);

    // Check if a file is selected for upload
    if (!empty($photo)) {
        // Move the uploaded file to the specified directory
        if (move_uploaded_file($temp_name, $target_file)) {
            // File uploaded successfully, now update the database with the new profile information
            $sql = "UPDATE faculty SET name='$name', mobile='$phone', email='$email', img='$target_file' WHERE fid=$_SESSION[floggedin]";
            if (mysqli_query($conn, $sql)) {
                echo '<script>alert("PROFILE UPDATE SUCCESSFULLY");</script>';
                echo '<script type="text/javascript">window.location="profile.php";</script>';
                exit;
            } else {
                // Error updating profile
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            // Failed to upload file
            echo "Failed to upload file.";
        }
    } else {
        // No file selected for upload
        echo "No file selected.";
    }
}

?>  


<!-- Your HTML and profile display code here -->



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User Profile</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div>
    <h1>&nbsp;</h1>
    </div>
    <div class="wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-5 mx-auto"> <!-- Added mx-auto class for centering -->
                    
                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="<?php echo $row['img']; ?>"
                                        alt="User profile picture" style="width: 150px; height: 150px;">
                                </div>
                             
                               
                                <ul class="list-group list-group-unbordered mb-3">
                                <div class="card-header">
    <h3 class="card-title">User Profile</h3>
</div>
<div class="card-body">
    

    

    <ul class="list-group list-group-unbordered mb-3">
        
        <li class="list-group-item">
        <strong><i class="fas fa-user mr-1"></i> Name</strong>
    <p class="text-muted"><?php echo $row['name']; ?></p>
        </li>
        <li class="list-group-item">
            <strong><i class="fas fa-envelope mr-1"></i> Email</strong>
            <p class="text-muted"><?php echo $row['email']; ?></p>
        </li>
        <li class="list-group-item">
            <strong><i class="fas fa-phone mr-1"></i> Phone</strong>
            <p class="text-muted"><?php echo $row['mobile']; ?></p>
        </li>
        
    </ul>

    <hr>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editProfileModal">
        Edit Profile
    </button>
</div>

                               
    </div>
</body>

</body>

    <!-- Main content -->
  

                        <!-- Modal -->
                        <div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Your edit profile form here -->
                                        <form action="profile.php" method="POST" enctype="multipart/form-data">
    <!-- Add your form fields for editing profile here -->
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['name']; ?>">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>">
    </div>
    <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $row['mobile']; ?>">
    </div>
   
    <div class="form-group">
        <label for="photo">Photo</label>
        <input type="file" class="form-control-file" id="photo" name="photo" >
    </div>
    <!-- Add other fields as needed -->
    <button type="submit" class="btn btn-primary">Update</button>
</form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

  </div>
</div>
</body>
</html>
