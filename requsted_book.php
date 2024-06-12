<?php 
include 'header.php';
if (!isset($_SESSION['loggedin'])) {
    // Redirect to the login page
    header("location: admin login.php");
    exit;
}

$res3 = mysqli_query($conn, "SELECT * FROM book_requests WHERE `key`='n'");
$knot = mysqli_num_rows($res3);
$status = ($knot > 0) ? "New" : "";

if ($knot > 0) {
    mysqli_query($conn, "UPDATE book_requests SET `key` = 'y'");
}

$sql = "SELECT * FROM book_requests";
$result = mysqli_query($conn, $sql);
?>
<div>  
 <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Book Request</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="adashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Book Request</li>
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
<title>Admin - Book Requests</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
   
    <div class="container">
    <div class="input-group input-group-sm mb-3">
         <input type="text" id="searchInput" class="form-control form-control-sm" onkeyup="searchTable()" placeholder="Search for Book...">
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
        <div class="table-responsive">
            
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID <?php echo $status; ?></th>
                        <th>Student Name</th>
                        <th>LID</th>
                        <th>Email</th>
                        <th>Book Name</th>
                        <th>Author Name</th>
                        <th>Book URL</th>
                        <th>Date Created</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>' . $row["id"] . '</td>';
                        echo '<td>' . $row["student_name"] . '</td>';
                        echo '<td>' . $row["lid"] . '</td>';
                        echo '<td>' . $row["email"] . '</td>';
                        echo '<td>' . $row["book_name"] . '</td>';
                        echo '<td>' . $row["author_name"] . '</td>';
                        echo '<td>' . $row["book_url"] . '</td>';
                        echo '<td>' . $row["date_created"] . '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
            <a href="msg.php" class="btn btn-primary">Message</a>
        </div>
    </div>
</body>
</html>
