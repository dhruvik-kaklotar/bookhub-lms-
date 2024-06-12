<?php 
include 'header.php';
if (!isset($_SESSION['loggedin'])) {
    // Redirect to the login page
    header("location: admin login.php");
    exit;
}
?>
<?php
// Database connection

// Check connection

// Fetch data from reg_student table
$sql = "SELECT * FROM issuedbook";
$result = $conn->query($sql);

if(isset($_POST['delete'])){
    $bookid = $_POST['delete'];
    $sql = "DELETE FROM issuedbook WHERE issueid='$bookid'";
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Close connection
$conn->close();
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
            <h1 class="m-0"><b>All Issued Books</b></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="adashboard.php">Home</a></li>
              <li class="breadcrumb-item active">All Books</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    </div>
   

<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-12">
                <div class="input-group input-group-sm mb-3">
                    <input type="text" id="searchInput" class="form-control form-control-sm" onkeyup="searchTable()" placeholder="Search for Issue ID...">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fa fa-search"></i></span>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All Issued Books</h3>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-sm mx-auto" id="issueTable">
                            <thead>
                                <tr>
                                    <th>Issue id</th>
                                    <th>Book id</th>
                                    <th>Book name</th>
                                    <th>Student name</th>
                                    <th>library id</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Issued date</th>
                                    <th>Return date</th>
                                    <th>Action</th>
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
                                    echo "<td>" . $row["studname"] . "</td>";
                                    echo "<td>" . $row["lid"] . "</td>";
                                    echo "<td>" . $row["email"] . "</td>";
                                    echo "<td>" . $row["phone"] . "</td>";
                                    echo "<td>" . $row["idate"] . "</td>";
                                    echo "<td>" . $row["rdate"] . "</td>";
                                    echo "<td>
                                            <button type='button' class='btn btn-danger' onclick='deleteRecord(" . $row["issueid"] . ")'>Delete</button>
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
            </div>
        </div>
    </div>
</section>

<script>
    function deleteRecord(issueId) {
    if (confirm('Are you sure you want to delete this record?')) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'allissuedbook.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                location.reload(); // Reload the page upon successful deletion
            } else {
                alert('Error deleting record: ' + xhr.responseText);
            }
        };
        xhr.send('delete=' + issueId);
    }
}


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
