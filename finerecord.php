<?php 
include 'header.php';
if (!isset($_SESSION['loggedin'])) {
    // Redirect to the login page
    header("location: admin login.php");
    exit;
} 

// Fetch data from finerecod table
$sql = "SELECT * FROM finerecod";
$result = $conn->query($sql);
?>
<style>
    .table tbody td {
        vertical-align: middle;
    }
</style>
<div>  
 <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Fine History</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="adashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Fine History</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    
<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-11">
            <div class="input-group input-group-sm mb-3">
                    <input type="text" id="searchInput" class="form-control form-control-sm" onkeyup="searchTable()" placeholder="Search for Issue ID...">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fa fa-search"></i></span>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Fine History</h3>
                    </div>
                    <div class="card-body p-0">
                        <!-- Search bar -->
                        
                        <br><br>
                        <table id="issueTable" class="table table-sm mx-auto">
                            <thead>
                                <tr>
                                    <th>Book id</th>
                                    <th>Student name</th>
                                    <th>Library id</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Issued date</th>
                                    <th>Return date</th>
                                    <th>Fine date</th>
                                    <th>Amount</th>
                                    <th>Pay date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row["bookid"] . "</td>";
                                        echo "<td>" . $row["student_name"] . "</td>";
                                        echo "<td>" . $row["library_id"] . "</td>";
                                        echo "<td>" . $row["email"] . "</td>";
                                        echo "<td>" . $row["phone"] . "</td>";
                                        echo "<td>" . $row["issued_date"] . "</td>";
                                        echo "<td>" . $row["return_date"] . "</td>";
                                        echo "<td>" . $row["fine_date"] . "</td>";
                                        echo "<td>" . $row["amount"] . "</td>";
                                        echo "<td>" . $row["paydate"] . "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='10'>0 results</td></tr>";
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

<script>
    function searchTable() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("issueTable");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those that do not match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0]; // Index of the Book ID column
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
