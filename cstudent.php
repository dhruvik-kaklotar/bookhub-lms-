<?php
include 'header.php';
if (!isset($_SESSION['loggedin'])) {
    // Redirect to the login page
    header("location: admin login.php");
    exit; // Ensure no further code execution after redirection
}

// Fetch course bookings from the database
$sql = "SELECT * FROM courcebooking";
$result = $conn->query($sql);
?>

<div>  
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>Course Students</b></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="adashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">All books</li>
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
    <title>Admin Course Bookings</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center" >
            <div class="col-md-12">
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
            td = tr[i].getElementsByTagName("td")[3]; // Index of the "Name" column
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
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Students</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                   
                        <table class="table table-sm mx-auto">
                                <tr>
                                    <th>Booking ID</th>
                                    <th>Student Name</th>
                                    <th>Student Email</th>
                                    <th>Course Name</th>
                                    <th>Apply Date</th>
                                    <th>Fee</th>
                                    <th>Duration</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row["cource_id"] . "</td>";
                                        echo "<td>" . $row["sname"] . "</td>";
                                        echo "<td>" . $row["semail"] . "</td>";
                                        echo "<td>" . $row["courcename"] . "</td>";
                                        echo "<td>" . $row["apply_date"] . "</td>";
                                        echo "<td>" . $row["fee"] . "</td>";
                                        echo "<td>" . $row["duration"] . "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='7'>No course bookings found.</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
