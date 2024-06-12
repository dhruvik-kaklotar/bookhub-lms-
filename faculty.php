<?php
include 'header.php';
if (!isset($_SESSION['loggedin'])) {
    // Redirect to the login page
    header("location: admin login.php");
    
}
?>
<div>  
 <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Faculty Registration</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="adashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Faculty Registraion</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Registration</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-warning">
                <div class="card-header">
                <h2 class="card-title" style="font-size: 25px; margin-left:60px">
    <i class="fas fa-user-graduate"></i>&nbsp;&nbsp; Faculty Registration Form</b>
</h2>

                </div>
                <div class="card-body">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="coursename" class="form-label">Course Name:</label>
                            <input type="text" class="form-control" id="coursename" name="coursename" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                       
                        <div class="mb-3">
                            <label for="mobile" class="form-label">Mobile:</label>
                            <input type="text" class="form-control" id="mobile" name="mobile" required>
                        </div>
                        <div class="mb-3">
                            <label for="joiningdate" class="form-label">Joining Date:</label>
                            <input type="date" class="form-control" id="joiningdate" name="joiningdate" required>
                        </div>
                        <div class="mb-3">
                            <label for="salary" class="form-label">Salary:</label>
                            <input type="text" class="form-control" id="salary" name="salary" required>
                        </div>
                        <div class="mb-3">
                            <label for="experience" class="form-label">Experience:</label>
                            <input type="text" class="form-control" id="experience" name="experience" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Bootstrap JS (Optional, if you need it) -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
</body>
</html>

<?php
// Check if form is submitted
if (isset($_POST['submit'])) {
    // Database connection
     // Assuming your database configuration is in 'config.php'

    // Retrieve form data
    $name = $_POST['name'];
    $coursename = $_POST['coursename'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $joiningdate = $_POST['joiningdate'];
    $salary = $_POST['salary'];
    $experience = $_POST['experience'];

    // Insert data into faculty table
    $sql = "INSERT INTO faculty (name, coursename, password, email, mobile, joiningdate, salary, experience) 
            VALUES ('$name', '$coursename', '$password', '$email', '$mobile', '$joiningdate', '$salary', '$experience')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Faculty registered successfully');</script>";
    } else {
        echo "Error: <br>";
    }

    // Close database connection
    
}
?>
