<?php include 'inc/config.php';
      include 'header.php';
      if (!isset($_SESSION['loggedin'])) {
        // Redirect to the login page
        header("location: admin login.php");
        exit;
    } ?>
 <div>  
 <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Registaion form</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="adashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Ragistaion form </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    
    <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Form Validation</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
        <div class="card card-success">
        <div class="card-header">
                    <h2 class="text-center">Registration Form</h2>
                </div>
              <div class="card-body">

                    <form id="myForm" action="ragistation.php" method="post">
                        <div class="mb-3">
                            <label for="exampleInputName" class="form-label">Clg id</label>
                            <input type="text" name="name" class="form-control" id="exampleInputName" placeholder="Enter your cid" required>
                         
                            
                        </div>
                       

                        

    
   <?php

   if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["name"])) {
       $clgId = $_POST["name"];
       
       $query = "SELECT * FROM clgstudent WHERE cid  ='$clgId'";
       $result = mysqli_query($conn, $query);
   
       if ($result && mysqli_num_rows($result) > 0) {
           $row = mysqli_fetch_assoc($result);
           $cid = $row["cid"];
           $name = $row["name"];
           $gender = $row["gender"];
           $address = $row["address"];
           $email = $row["email"];
           $phone = $row["phone"];
           $sem = $row["sem"];
           $dept = $row["dept"];
   
          
       } else {
           echo "<script>alert('No data found for Clg id: $clgId');</script>";
       }
   }
   ?>
   

                        <button type="button" class="btn btn-primary" id="searchBtn">Search</button>
                        <script>
    $(document).ready(function() {
        $("#searchBtn").click(function() {
            $("#myForm").submit();
        });
    });
</script>
</form>
<form action="ragistation.php" method="post">
<div class="mb-3">
                            <label for="exampleInputName" class="form-label">Collage id</label>
                            <input type="text" name="cid" class="form-control" id="exampleInputName" value="<?php echo isset($cid) ? $cid : ''; ?>" required placeholder="enter collage id">
                            
                            
                        </div>
<div class="mb-3">
                            <label for="exampleInputName" class="form-label">Name</label>
                            <input type="text" name="aname" class="form-control" id="exampleInputName" value="<?php echo isset($name) ? $name : ''; ?>" required placeholder="Enter your name">
                            
                            
                        </div>
<div class="mb-3">
    <label for="exampleInputEmail" class="form-label">Email</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail" value="<?php echo isset($email) ? $email : ''; ?>" placeholder="Enter your email" required>
    
    <div class="invalid-feedback">Please enter a valid email.</div>
<div class="mb-3">
    <label for="exampleInputEmail" class="form-label">Gender</label>
    <input type="text" name="gender" class="form-control" id="exampleInputEmail" value="<?php echo isset( $gender) ?  $gender : ''; ?>" placeholder="Enter your Gender" required>
    
    <div class="invalid-feedback">Please enter a valid email.</div>
</div>
<div class="mb-3">
    <label for="exampleInputPhone" class="form-label">Phone</label>
    <input type="text" name="phone" class="form-control" id="exampleInputPhone" value="<?php echo isset($phone) ? $phone : ''; ?>" placeholder="Enter your phone number" required>
    
    <div class="invalid-feedback">Please enter a valid phone number.</div>
</div>
<div class="mb-3">
    <label for="exampleInputPhone" class="form-label">Address</label>
    <input type="text" name="address" class="form-control" id="exampleInputPhone" value="<?php echo isset($address) ? $address : ''; ?>" placeholder="Enter your address " required>
    
    <div class="invalid-feedback">Please enter a valid phone number.</div>
</div>
<div class="mb-3">
    <label for="exampleInputSemester" class="form-label">Semester</label>
    <input type="text" name="sem" class="form-control" id="exampleInputSemester" value="<?php echo isset($sem) ? $sem : ''; ?>" placeholder="Enter your semester" required>
    
    <div class="invalid-feedback">Please enter a valid semester.</div>
</div>
<div class="mb-3">
    <label for="exampleInputDepartment" class="form-label">Department</label>
    <input type="text" name="dept" class="form-control" id="exampleInputSemester" value="<?php echo isset($dept) ? $dept : ''; ?>" placeholder="Enter your department" required>
    
    <div class="invalid-feedback">Please select your department.</div>
</div>

<div class="mb-3">
    <label for="exampleInputRdate" class="form-label">Registration Date</label>
    <input type="date" name="rdate" class="form-control" id="exampleInputRdate"  required>
    
    <div class="invalid-feedback">Please enter a valid registration date.</div>
</div>
<div class="mb-3">
    <label for="exampleInputId" class="form-label">ID</label>
    <input type="text" name="lid" class="form-control" id="exampleInputId"  placeholder="Enter your ID" required>
    
    <div class="invalid-feedback">Please enter a valid ID.</div>
</div>
<div class="mb-3">
    <label for="exampleInputPassword" class="form-label">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword" placeholder="Enter your password" required>
    
    <div class="invalid-feedback">Please enter a valid password.</div>
</div>
                     <button name="dhr" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
<?php




if (isset($_POST['dhr'])) {
    $coid = $_POST['cid'];
    $name = $_POST['aname'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $sem = $_POST['sem'];
    $dept = $_POST['dept'];
    $lid = $_POST['lid'];
    $password = $_POST['password'];
   
    $rdate = $_POST['rdate'];

    $query = "INSERT INTO reg_student (cid, name, gender, address, email, phone, sem, dept, lid, password, rdate) VALUES ('$coid', '$name', '$gender', '$address', '$email', '$phone', '$sem', '$dept', '$lid', '$password', '$rdate')";

    if (mysqli_query($conn, $query)) {
        echo '<div class="alert alert-success" role="alert">Data inserted successfully!</div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">Error inserting data: ' . mysqli_error($link) . '</div>';
    }
}

?>


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

</body>
</html>
