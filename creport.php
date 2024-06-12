<?php include 'header.php'; ?>
<?php
if (!isset($_SESSION['loggedin'])) {
    // Redirect to the login page
    header("location: admin login.php");
    exit;
}?>
<div>  
 <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><b>Course Report</b></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="adashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Course Report</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    </div>
    <div>
    <h1>&nbsp;</h1>
</div>
<div class="container" style="width: 500px;">
<h3>Select Course</h3>
<form method="post">
    <select name="reg1" id="reg1" class="form-control" >
        <?php 
        $res= mysqli_query($conn, "SELECT courcename FROM course");
        while($row=mysqli_fetch_array($res)){
            echo "<option value='" . $row["courcename"] . "'>";
            echo $row["courcename"];
            echo "</option>";
        }
        ?>
    </select>
    <br>
    <button type="submit" class="btn btn-primary" style="margin-bottom: 60px;">Submit</button>
</form>
<?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['reg1'])) {
        $courseName = $_POST['reg1'];
        
        // SQL query to select unique dates and their corresponding reports for the selected course
        $sql = "SELECT DISTINCT date, report FROM attendance WHERE coursename = '$courseName'";
        
        // Execute the query
        $result = mysqli_query($conn, $sql);
        
        // Check if there are any records
        if (mysqli_num_rows($result) > 0) {
            // Display the table headers
            echo "<h4>Daily Report</h4>";
            echo "<table class='table'>";
            echo "<thead><tr><th>Date</th><th>Report</th></tr></thead>";
            echo "<tbody>";
            
            // Fetch and display each row of the result
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["date"] . "</td>";
                echo "<td>" . $row["report"] . "</td>";
                echo "</tr>";
            }
            
            // Close the table
            echo "</tbody>";
            echo "</table>";
        } else {
            echo "<p>No records found for the selected course.</p>";
        }
    }
}
?>


</div>