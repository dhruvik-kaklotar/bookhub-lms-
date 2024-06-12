<?php 
    include 'header.php';
    if (!isset($_SESSION['loggedin'])) {
        // Redirect to the login page
        header("location: admin login.php");
        exit;
    } 

    // Database connection

    // Fetch data from issuedbook table
    $sql = "SELECT * FROM issuedbook";
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
            <h1 class="m-0">New Fine</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="adashboard.php">Home</a></li>
              <li class="breadcrumb-item active">New Fine</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div>
        <h1>&nbsp;</h1>
    </div>
<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">New Fine</h3>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-sm mx-auto">
                            <thead>
                                <tr>
                                    
                                    <th>Book id</th>
                                    <th>Book name</th>
                                    <th>Student name</th>
                                    <th>Library id</th>
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
                                        $currentDate = date('Y-m-d');
                                        if ($currentDate > $row["rdate"]){
                                            echo "<tr>";
                                         
                                            echo "<td>" . $row["bookid"] . "</td>";
                                            echo "<td>" . $row["bookname"] . "</td>";
                                            echo "<td>" . $row["studname"] . "</td>";
                                            echo "<td>" . $row["lid"] . "</td>";
                                            echo "<td>" . $row["email"] . "</td>";
                                            echo "<td>" . $row["phone"] . "</td>";
                                            echo "<td>" . $row["idate"] . "</td>";
                                            echo "<td>" . $row["rdate"] . "</td>";
                                            echo "<td>
                                                <form method='post'>
                                                    <button type='button' class='btn btn-danger edit-btn' data-toggle='modal' data-target='#editModal'
                                                        data-bookid='" . $row["bookid"] . "'
                                                        data-name='" . $row["studname"] . "'
                                                        data-categories='" . $row["lid"] . "'
                                                        data-price='" . $row["email"] . "'
                                                        data-authorname='" . $row["phone"] . "'
                                                        data-idate='" . date('Y-m-d', strtotime($row["idate"])) . "'
                                                        data-rdate='" . date('Y-m-d', strtotime($row["rdate"])) . "'
                                                       
                                                    >Fine</button>
                                                    
                                                </form>
                                            </td>";
                                            echo "</tr>";
                                        }
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

<div id="editModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Book</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="form-group">
                        <label for="edit-bookid">Book id:</label>
                        <input type="text" class="form-control" id="edit-bookid" name="bookid" readonly>
                    </div>
                    <div class="form-group">
                        <label for="edit-name">Student name:</label>
                        <input type="text" class="form-control" id="edit-name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="edit-categories">Library id:</label>
                        <input type="text" class="form-control" id="edit-categories" name="categories">
                    </div>
                    <div class="form-group">
                        <label for="edit-price">Email:</label>
                        <input type="text" class="form-control" id="edit-price" name="price">
                    </div>
                    <div class="form-group">
                        <label for="edit-authorname">Phone:</label>
                        <input type="text" class="form-control" id="edit-authorname" name="authorname">
                    </div>
                    <div class="form-group">
                        <label for="edit-idate">Issued date:</label>
                        <input type="date" class="form-control" id="edit-idate" name="idate">
                    </div>
                    <div class="form-group">
                        <label for="edit-rdate">Return date:</label>
                        <input type="date" class="form-control" id="edit-rdate" name="rdate">
                    </div>
                    <div class="form-group">
                        <label for="edit-fdate">Fine date:</label>
                        <input type="date" class="form-control" id="edit-fdate" name="fdate">
                    </div>
                    <div class="form-group">
                        <label for="edit-fdate">Amount</label>
                        <input type="text" class="form-control" value="&#8377; 100" />

                        
                    </div>
                    <button type="submit" name="update" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
if (isset($_POST['update'])) {
    // Retrieve form data
    $bookid = $_POST['bookid'];
    $student_name = $_POST['name'];
    $library_id = $_POST['categories'];
    $email = $_POST['price'];
    $phone = $_POST['authorname'];
    $issued_date = $_POST['idate'];
    $return_date = $_POST['rdate'];
    $fine_date = $_POST['fdate'];
    $amount = 100; // Assuming the fine amount is fixed at 100

    // Insert data into fine table
    $sql_insert = "INSERT INTO pfine (bookid, student_name, library_id, email, phone, issued_date, return_date, fine_date, amount) 
            VALUES ('$bookid', '$student_name', '$library_id', '$email', '$phone', '$issued_date', '$return_date', '$fine_date', '$amount')";                                                                                                                                               

    if ($conn->query($sql_insert) === TRUE) {
        // Delete the record from issuedbook table
        $sql_delete = "DELETE FROM issuedbook WHERE bookid='$bookid'";
        if ($conn->query($sql_delete) === TRUE) {
            echo "<script>alert('fine apply successfully');</script>";
            echo "<meta http-equiv='refresh' content='0'>";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    } else {
        echo "Error inserting data into fine table: " . $conn->error;
    }
}
?>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
    $('.edit-btn').click(function(){
        var bookid = $(this).data('bookid');
        var name = $(this).data('name');
        var categories = $(this).data('categories');
        var price = $(this).data('price');
        var authorname = $(this).data('authorname');
        var idate = $(this).data('idate');
        var rdate = $(this).data('rdate');
        var fdate = $(this).data('fdate');
        
        $('#edit-bookid').val(bookid);
        $('#edit-name').val(name);
        $('#edit-categories').val(categories);
        $('#edit-price').val(price);
        $('#edit-authorname').val(authorname);
        $('#edit-idate').val(idate);
        $('#edit-rdate').val(rdate);
        $('#edit-fdate').val(fdate);
        
        // Set fine date to current date
        var currentDate = new Date().toISOString().slice(0,10);
        $('#edit-fdate').val(currentDate);
        
    });
});

</script>
