<?php
include 'inc/config.php';
include 'header.php';
if (!isset($_SESSION['loggedin'])) {
    // Redirect to the login page
    header("location: admin login.php");
    exit;
}
?>

<div>  
 <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">New Issued Book</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="adashboard.php">Home</a></li>
              <li class="breadcrumb-item active">New Issued Book</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div>
        <h1>&nbsp;</h1>
    </div>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-success">
                
                <div class="card-header">
                    <h3 class="card-title">Registration Form</h3>
                </div>
                <div class="card-body">
                <form id="myForm" action="newissuebook.php" method="post">
             
                                                <h3>select library id</h3>
												<select name="reg1" id="reg1" class="form-control">
													 <?php 
                                                        $res= mysqli_query($conn, "select lid  from reg_student");
                                                        while($row=mysqli_fetch_array($res)){
                                                            echo "<option>";
                                                            echo $row["lid"];
                                                            echo "</option>";
                                                        }
                                                    ?>
                                                    
												</select>
                                                <h3>select book id</h3>
                                                <select name="reg" id="reg" class="form-control">
        <?php 
        $res = mysqli_query($conn, "SELECT bookid, name FROM books");
        while($row = mysqli_fetch_array($res)){
            echo "<option value='".$row["bookid"]."'>".$row["bookid"]."</option>";


        }
        ?>
    </select>
											
												<input type="submit" class="btn btn-info" value="select" name="submit">
                                                <?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $selectedBookId = $_POST["reg"];
    $query = "SELECT * FROM books WHERE bookid='$selectedBookId'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $bid = $row["bookid"];
        $bname = $row["name"];
    } else {
        echo "<script>alert('No data found for Book ID: $selectedBookId');</script>";
    }
}
?>

									
                       
 

   <?php
   // Assuming you have a database connection established already
   if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
       $clgId = $_POST["reg1"];
       
       $query = "SELECT * FROM reg_student WHERE lid  ='$clgId'";
       $result = mysqli_query($conn, $query);
   
       if ($result && mysqli_num_rows($result) > 0) {
           $row = mysqli_fetch_assoc($result);
           $lid = $row["lid"];
           $name = $row["name"];
           $email = $row["email"];
           $phone = $row["phone"];
         
   
          
       } else {
           echo "<script>alert('No data found for Clg id: $clgId');</script>";
       }
   }
   ?>
   

                        <script>
    $(document).ready(function() {
        $("#searchBtn").click(function() {
            $("#myForm").submit();
        });
    });
</script></form>
<form  action="newissuebook.php" method="post">
                 <div class="mb-3">
                            <label for="exampleInputStudName" class="form-label">Library ID</label>
                            <input type="text" name="a"  value="<?php echo isset($lid) ? $lid: ''; ?>" class="form-control" id="exampleInputStudName" placeholder="Enter student name" required>
                            </div>
                          <div class="mb-3">
                            <label for="exampleInputLid" class="form-label">Student Name</label>
                            <input type="text" name="b" value="<?php echo isset($name) ? $name: ''; ?>"class="form-control" id="exampleInputLid" placeholder="Enter library ID" required>
                          </div>
                          <div class="mb-3">
                            <label for="exampleInputLid" class="form-label">Email</label>
                            <input type="text" name="c" value="<?php echo isset($email) ? $email: ''; ?>"class="form-control" id="exampleInputLid" placeholder="Enter library ID" required>
                          </div>
                          <div class="mb-3">
                            <label for="exampleInputLid" class="form-label">contect no</label>
                            <input type="text" name="d" value="<?php echo isset($phone) ? $phone: ''; ?>"class="form-control" id="exampleInputLid" placeholder="Enter library ID" required>
                          </div>

                    
         

<div class="mb-3">
    <label for="exampleInputLid" class="form-label">Book ID</label>
    <input type="text" name="e" value="<?php echo isset($bid) ? $bid : ''; ?>" class="form-control" id="exampleInputLid" placeholder="Enter library ID" required>
</div>
<div class="mb-3">
    <label for="exampleInputLid" class="form-label">Book Name</label>
    <input type="text" name="f" value="<?php echo isset($bname) ? $bname : ''; ?>" class="form-control" id="exampleInputLid" placeholder="Enter library ID" required>
</div>


                       <div class="mb-3">
    <label for="exampleInputIdate" class="form-label">Issue Date</label>
    <input type="date" name="idate" class="form-control" id="exampleInputIdate" value="<?php echo date('Y-m-d'); ?>" required>
</div>

<div class="mb-3">
    <label for="exampleInputRdate" class="form-label">Return Date</label>
    <input type="date" name="rdate" class="form-control" id="exampleInputRdate" value="<?php echo date('Y-m-d', strtotime('+15 days')); ?>" required>
</div>

                       

                       

<input type="submit" class="btn btn-info" value="select" name="dhr">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>




<?php
if (isset($_POST['dhr'])) {
    $lid = $_POST["a"];
    $bid = $_POST["e"];
    $idate = $_POST["idate"];
    $rdate = $_POST["rdate"];
    $bookname = $_POST["f"];
    $studname = $_POST["b"];
    $email = $_POST["c"];
    $phone = $_POST["d"];
    $query_check = "SELECT * FROM issuedbook WHERE studname='$studname' AND bookid='$bid'";
    $result_check = mysqli_query($conn, $query_check);
    // Database connection and insertion into issuedbook table
    if (mysqli_num_rows($result_check) > 0) {
        echo '<script>alert("This student has already issued this book.");</script>';
    } else {
        // Database connection and insertion into issuedbook table
        $query_issuedbook = "INSERT INTO issuedbook (bookid, bookname, idate, rdate, studname, email, phone, lid) 
                          VALUES ('$bid', '$bookname', '$idate', '$rdate', '$studname', '$email', '$phone', '$lid')";
        mysqli_query($conn, $query_issuedbook);

        // Get the issueid from the inserted row in issuedbook table
        $issueid = mysqli_insert_id($conn);

        // Insert data into issuerecord table
        $query_issuerecord = "INSERT INTO issurecord ( bookid, bookname, idate, rdate, studname, email, phone, lid) 
                          VALUES ( '$bid', '$bookname','$idate', '$rdate', '$studname', '$email', '$phone', '$lid')";
        mysqli_query($conn, $query_issuerecord);

        echo '<script>alert("Data inserted successfully!");</script>';
    }
}?>


<!-- Your existing HTML form -->


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
