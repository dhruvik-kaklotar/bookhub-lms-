<?php 
include 'header.php';
if (!isset($_SESSION['loggedin'])) {
    // Redirect to the login page
    header("location: admin login.php");
    exit;
} 

// Database connection
// Assuming you have already established the database connection here

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle deletion if form is submitted
if(isset($_POST['delete'])){
    $fid = $_POST['fid'];
    $sql = "DELETE FROM faculty WHERE fid='$fid'";
    if ($conn->query($sql) === TRUE) {
        // Set a flag to indicate successful deletion
        $delete_success = true;
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Fetch data from faculty table
$sql = "SELECT * FROM faculty";
$result = $conn->query($sql);

// Close connection
$conn->close();
?>


<div>  
 <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><b>All Faclulty</b></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="adashboard.php">Home</a></li>
              <li class="breadcrumb-item active">All Faculty</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    </div>
    
<!DOCTYPE html>
<html>
<head>
    <title>Faculty Management</title>
    <style>
        .table tbody td {
            vertical-align: middle;
        }
        .success-message {
            display: none;
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #4CAF50;
            color: white;
            padding: 15px 25px;
            border-radius: 5px;
            z-index: 9999;
        }
    </style>
</head>
<body>

<section class="content">
    <div class="container-fluid">
    <div class="input-group input-group-sm mb-3">
        <input type="text" id="searchInput" class="form-control form-control-sm" onkeyup="searchTable()" placeholder="Search ...">
        <div class="input-group-append">
            <span class="input-group-text"><i class="fa fa-search"></i></span>
        </div>
    </div>


    <script>
    function searchTable() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.querySelector(".table");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[2]; // Index of the "Name" column
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>
        <div class="row justify-content-center align-items-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Faculty Management</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <table class="table table-sm mx-auto">
                            <thead>
                                <tr>
                                    <th style="width: 10px">Faculty ID</th>
                                    <th>Name</th>
                                    <th>Course Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Join Date</th>
                                    <th>Salary</th>
                                    <th>Experience</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row["fid"] . "</td>";
                                        echo "<td>" . $row["name"] . "</td>";
                                        echo "<td>" . $row["coursename"] . "</td>";
                                        echo "<td>" . $row["email"] . "</td>";
                                        echo "<td>" . $row["mobile"] . "</td>";
                                        echo "<td>" . $row["joiningdate"] . "</td>";
                                        echo "<td>" . $row["salary"] . "</td>";
                                        echo "<td>" . $row["experience"] . "</td>";
                                        echo "<td>
                                            <form method='post'>
                                                <input type='hidden' name='fid' value='" . $row["fid"] . "'>
                                                <button type='submit' name='delete' class='btn btn-danger'>Delete</button>
                                            </form>
                                        </td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "0 results";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-right">
                            <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                        </ul>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>
<div class="success-message" id="successMessage">Record deleted successfully</div>
</body>
<script>
// Check if deletion is successful and show a success message
<?php if(isset($delete_success) && $delete_success): ?>
    document.getElementById('successMessage').style.display = 'block';
    setTimeout(function(){
        document.getElementById('successMessage').style.display = 'none';
    }, 3000);
<?php endif; ?>
</script>
</html>
