<?php

include 'header.php';

// Check if the user is logged in
if (!isset($_SESSION['loggedin'])) {
    // Redirect to the login page
    header("location: admin login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $attachment = $_FILES['attachment']['name'];

    // Move uploaded file to uploads folder
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["attachment"]["name"]);
    move_uploaded_file($_FILES["attachment"]["tmp_name"], $target_file);

    $sender_name = $_SESSION['loggedin'];

    // Insert message into the database
    $sql = "INSERT INTO allmessages (sender_name, subject, message, attachment, `key`)
    VALUES ('$sender_name', '$subject', '$message', '$attachment', 'n')";

    if (mysqli_query($conn, $sql)) {
        echo "Message sent successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>
<div>  
 <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><b>Messege</b></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="adashboard.php">Home</a></li>
              <li class="breadcrumb-item active">All Messege</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    </div>
   
<div class="col-md-9" style="margin-top: 50px;margin-left: 150px;">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">Compose New Message</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <input class="form-control" placeholder="Subject:" name="subject">
                </div>
                <div class="form-group">
                    
                    <textarea id="compose-textarea" class="form-control" style="height: 300px" name="message"></textarea>
                </div>
                <div class="form-group">
                    <label for="attachment"><i class="fas fa-paperclip"></i>Attachment:</label>
                    <input type="file" name="attachment" id="attachment" class="form-control-file">
                </div>
                <p class="help-block">Max. 32MB</p>
                <button type="submit" class="btn btn-primary"><i class="far fa-envelope"></i> Send</button>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.col -->


