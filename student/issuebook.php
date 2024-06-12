<?php 
include 'config.php';
include 'header.php';

// Check if the user is logged in
if (!isset($_SESSION['sloggedin'])) {
    // Redirect to the login page
    header("location: slogin.php");
    exit;
}

// Fetch the logged-in student's information
$studname = $_SESSION['sloggedin']; // Assuming 'name' is used to identify students

// Fetch data from issuedbook table for the logged-in student
$sql = "SELECT * FROM issuedbook WHERE lid='$studname'";
$result = $conn->query($sql);


// Close connection
$conn->close();
?>

<!-- Your HTML and table display code here -->



<!-- Your HTML and table display code here -->


<style>
    .table tbody td {
        vertical-align: middle;
    }
   
    .blink {
        animation: blinker 1s linear infinite;
        color: red;
    }

    @keyframes blinker {
        50% {
            opacity: 0;
        }
    }
</style>

</style>
<div>
    <h1>&nbsp  </h1>
    <h1>  &nbsp</h1>
</div>


<section class="content">
    <div class="container-fluid">
   
</div>

        <div class="row justify-content-center align-items-center" >
       
            <div class="col-md-10">
            <div class="input-group input-group-sm mb-3">
    <input type="text" id="searchInput" class="form-control form-control-sm" onkeyup="searchTable()" placeholder="Search for Issue ID...">
    <div class="input-group-append">
        <span class="input-group-text"><i class="fa fa-search"></i></span>
    </div>
</div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Student Registration</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                   
                    <table class="table table-sm mx-auto" id="issueTable">

                            <thead>
                                <tr>
                                    
                                    <th >Issue id</th>
                                    <th >Book id</th>
                                    <th>Book name</th>
                                   
                                    <th>Issued date</th>
                                    <th>Return date</th>
                                    <th>Days left &#8986;</th>

                                </tr>
                            </thead>          
                            <tbody>
                            <?php     
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["issueid"] . "</td>";
            echo "<td>" . $row["bookid"] . "</td>";
            echo "<td>" . $row["bookname"] . "</td>";

            // Format the issue date to dd-mm-yyyy
            $issueDate = date("d-m-Y", strtotime($row["idate"]));
            echo "<td>" . $issueDate . "</td>";

            // Format the return date to dd-mm-yyyy
            $returnDate = date("d-m-Y", strtotime($row["rdate"]));
            echo "<td>" . $returnDate . "</td>";
            
            // Calculate the number of days left
            $currentDate = date("Y-m-d");
            $diff = strtotime($returnDate) - strtotime($currentDate);
            $daysLeft = floor($diff / (60 * 60 * 24));

            // Display the days left with blinking and red color if only 2 days are left
            if ($daysLeft <= 2) {
                echo "<td class='blink'>" . $daysLeft . "</td>";
            } else {
                echo "<td>" . $daysLeft . "</td>";
            }
            
            echo "</tr>";
        }
    } else {
        echo "0 results";
    }
    ?> </tbody>
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
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
            td = tr[i].getElementsByTagName("td")[0]; // Index of the Issue ID column
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

