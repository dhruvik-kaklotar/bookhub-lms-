<?php
include 'header.php';

// Check if the user is logged in
if (!isset($_SESSION['sloggedin'])) {
    header("Location: slogin.php");
    exit;
}

// Fetch user information based on name
$name = $_SESSION['sloggedin'];
$sql = "SELECT * FROM reg_student WHERE lid='$name'";
$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
} else {
    echo "Error: " . mysqli_error($conn);
}

// Handle form submission for updating user information
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];

    // Handle file upload (if needed)
    if ($_FILES["photo"]["size"] > 0) {
        $photo = $_FILES["photo"]["name"];
        $temp_name = $_FILES["photo"]["tmp_name"];
        $target_dir = "bimg/";
        $target_file = $target_dir . basename($photo);
        
        // Check if file was uploaded successfully
        if (move_uploaded_file($temp_name, $target_file)) {
            // Update the database with the new profile information including photo
            $sql = "UPDATE reg_student SET name='$name', email='$email', phone='$phone', address='$address', photo='$target_file' WHERE lid='$_SESSION[sloggedin]'";
            if (mysqli_query($conn, $sql)) {
                echo '<script>alert("PROFILE UPDATED SUCCESSFULLY");</script>';
                echo '<script type="text/javascript">window.location="profile.php";</script>';
                exit;
            } else {
                echo "Error updating profile: " . mysqli_error($conn);
            }
        } else {
            echo "Error uploading photo.";
        }
    } else {
        // If no photo is uploaded, update other fields only
        $sql = "UPDATE reg_student SET name='$name', email='$email', phone='$phone', address='$address' WHERE lid='$_SESSION[sloggedin]'";
        if (mysqli_query($conn, $sql)) {
            echo '<script>alert("PROFILE UPDATED SUCCESSFULLY");</script>';
            echo '<script type="text/javascript">window.location="profile.php";</script>';
            exit;
        } else {
            echo "Error updating profile: " . mysqli_error($conn);
        }
    }
}
?>
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
    <style>
        .success-message {
            display: none;
            background-color: #d4edda;
            color: #155724;
            border-color: #c3e6cb;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">
<div>
    <h1>&nbsp;</h1>
    </div>
<div class="wrapper">
    <section class="content">
        <div class="container-fluid">
        <div class="success-message" id="successMessage">Record deleted successfully</div>
            <div class="row">
                <div class="col-md-5 mx-auto"> <!-- Added mx-auto class for centering -->
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                     src="<?php echo $row['photo']; ?>"
                                     alt="User profile picture"  style="width: 150px; height: 150px;">
                            </div>
                            <ul class="list-group list-group-unbordered mb-3">
                                <div class="card-header">
                                    <h3 class="card-title">User Profile</h3>
                                </div>
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
                                            <p class="text-muted"><?php echo $row['phone']; ?></p>
                                        </li>
                                        <li class="list-group-item">
                                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Address</strong>
                                            <p class="text-muted"><?php echo $row['address']; ?></p>
                                        </li>
                                    </ul>
                                <div class="card-body">
                                    <!-- Edit Profile Button -->
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editProfileModal">
                                        Edit Profile
                                    </button>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Edit Profile Modal -->
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
                    <!-- Edit Profile Form -->
                    <form action="profile.php" method="POST" enctype="multipart/form-data">
                        <!-- Form fields for editing profile -->
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
                            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $row['phone']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="<?php echo $row['address']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="photo">Profile Photo</label>
                            <input type="file" class="form-control-file" id="photo" name="photo">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script>
    <?php if(isset($delete_success) && $delete_success): ?>
        document.getElementById('successMessage').style.display = 'block';
        setTimeout(function(){
            document.getElementById('successMessage').style.display = 'none';
        }, 3000);
    <?php endif; ?>
</script>
</html>
