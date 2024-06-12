<?php
include 'header.php';
if (!isset($_SESSION['loggedin'])) {
    // Redirect to the login page
    header("location: admin login.php");
    exit;
}

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Delete record
if(isset($_POST['delete'])){
    $courcid = $_POST['delete'];
    $sql = "DELETE FROM course WHERE courcid='$courcid'";
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Update record
if(isset($_POST['update'])){
    $courcid = $_POST['courcid'];
    $courcename = $_POST['courcename'];
    $description = $_POST['description'];
    $duration = $_POST['duration'];
    $fee = $_POST['fee'];
    $date = $_POST['date'];
    $faculty = $_POST['faculty'];

    $sql = "UPDATE course SET courcename='$courcename', description='$description', duration='$duration', fee='$fee', date='$date', faculty='$faculty' WHERE courcid='$courcid'";
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Fetch data from course table
$sql = "SELECT * FROM course";
$result = $conn->query($sql);
?>
<div>  
 <div class="content-header">
      <div class="container-fluid">
     

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
            td = tr[i].getElementsByTagName("td")[1]; // Index of the "Name" column
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
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Course</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="adashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Manage Course</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
   
<section class="content">
    <div class="container-fluid">
    <div class="input-group input-group-sm mb-3">
        <input type="text" id="searchInput" class="form-control form-control-sm" onkeyup="searchTable()" placeholder="Search for Book...">
        <div class="input-group-append">
            <span class="input-group-text"><i class="fa fa-search"></i></span>
        </div>
    </div>
        <div class="row justify-content-center align-items-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Courses</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <table class="table table-sm mx-auto">
                            <thead>
                                <tr>
                                    <th>Course ID</th>
                                    <th>Course Name</th>
                                    <th>Description</th>
                                    <th>Duration</th>
                                    <th>Fee</th>
                                    <th>Date</th>
                                    <th>Faculty</th>
                                    <th>Action</th> <!-- Add this column for edit and delete buttons -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row["courcid"] . "</td>";
                                        echo "<td>" . $row["courcename"] . "</td>";
                                        echo "<td>" . $row["description"] . "</td>";
                                        echo "<td>" . $row["duration"] . "</td>";
                                        echo "<td>" . $row["fee"] . "</td>";
                                        echo "<td>" . $row["date"] . "</td>";
                                        echo "<td>" . $row["faculty"] . "</td>";
                                        echo "<td>
                                                <form method='post'>
                                                    <button type='button' class='btn btn-primary edit-btn' data-toggle='modal' data-target='#editModal'
                                                        data-courcid='" . $row["courcid"] . "'
                                                        data-courcename='" . $row["courcename"] . "'
                                                        data-description='" . $row["description"] . "'
                                                        data-duration='" . $row["duration"] . "'
                                                        data-fee='" . $row["fee"] . "'
                                                        data-date='" . $row["date"] . "'
                                                        data-faculty='" . $row["faculty"] . "'
                                                    >Edit</button>
                                                    <button type='button' class='btn btn-danger delete-btn' data-courcid='" . $row["courcid"] . "'>Delete</button>
                                                </form>
                                            </td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='8'>0 results</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>

<div id="editModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Course</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="form-group">
                        <label for="edit-courcename">Course Name:</label>
                        <input type="text" class="form-control" id="edit-courcename" name="courcename">
                    </div>
                    <div class="form-group">
                        <label for="edit-description">Description:</label>
                        <textarea class="form-control" id="edit-description" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="edit-duration">Duration:</label>
                        <input type="text" class="form-control" id="edit-duration" name="duration">
                    </div>
                    <div class="form-group">
                        <label for="edit-fee">Fee:</label>
                        <input type="text" class="form-control" id="edit-fee" name="fee">
                    </div>
                    <div class="form-group">
                        <label for="edit-date">Date:</label>
                        <input type="date" class="form-control" id="edit-date" name="date">
                    </div>
                    <div class="form-group">
                        <label for="edit-faculty">Faculty:</label>
                        <input type="text" class="form-control" id="edit-faculty" name="faculty">
                    </div>
                    <input type="hidden" id="edit-courcid" name="courcid">
                    <button type="submit" name="update" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        $('.edit-btn').click(function(){
            var courcid = $(this).data('courcid');
            var courcename = $(this).data('courcename');
            var description = $(this).data('description');
            var duration = $(this).data('duration');
            var fee = $(this).data('fee');
            var date = $(this).data('date');
            var faculty = $(this).data('faculty');

            $('#edit-courcid').val(courcid);
            $('#edit-courcename').val(courcename);
            $('#edit-description').val(description);
            $('#edit-duration').val(duration);
            $('#edit-fee').val(fee);
            $('#edit-date').val(date);
            $('#edit-faculty').val(faculty);
        });

        $('.delete-btn').click(function(){
            if(confirm("Are you sure you want to delete this course?")) {
                var courcid = $(this).data('courcid');
                $.ajax({
                    url: 'managec.php',
                    type: 'post',
                    data: {delete: courcid},
                    success:function(response) {
                        // alert(response);
                        location.reload();
                    }
                });
            }
        });
    });
</script>
