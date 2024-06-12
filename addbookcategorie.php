<?php
include 'header.php';
if (!isset($_SESSION['loggedin'])) {
    // Redirect to the login page
    header("location: admin login.php");
    exit;
}
?>
<?php


if (isset($_POST['submit'])) {
    $Categorie = $_POST['Categorie'];

            $query = "INSERT INTO `newcategorie`(`Categorie_name`) VALUES ('$Categorie')";
            if (mysqli_query($conn, $query)) {
                echo "Record inserted successfully";
            } else {
                echo "Error inserting record: " . mysqli_error($conn);
            }

}

mysqli_close($conn);
?>


<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Add New Book Categorie</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="adashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Add book</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-success">
              <div class="card-header">
               <center> <h3 class="card-title">Add New Book Categories</h3></center>
             
              </div>
            <div class="card shadow">
                <div class="card-body">
                    <form action="addbookcategorie.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="Categorie" class="form-label">Enter New Categorie:</label>
                            <input type="text" name="Categorie" class="form-control" id="Categorie" required>
                        </div>

                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

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
