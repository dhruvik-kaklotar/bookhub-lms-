<?php include 'header.php'; ?>
<?php
if (!isset($_SESSION['loggedin'])) {
    // Redirect to the login page
    header("location: admin login.php");
    exit;
}

// Insert a message into the messages table
if (isset($_POST["receiver_id"]) && isset($_POST["message"])) {
    $receiverId = $_POST["receiver_id"];
    $message = $_POST["message"];

    $sql = "INSERT INTO messages (sender_name,receiver_id, message, `KEY`) VALUES ('" . $_SESSION['loggedin'] . "','$receiverId', '$message', 'n')";

    if (mysqli_query($conn, $sql)) {
        echo "Message sent successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
} else {
    echo " ";
}
?>
<div>  
 <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Messege</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="adashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Messege</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
   
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Message</title>
</head>
<body>
<div>
    <h1>&nbsp</h1>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-warning" >
                <div class="card-header">
                    <center><h3 class="card-title">Send Message &#x1F4AC; <!-- Unicode for 💬 emoji -->
</h3></center>
                </div>
                <div class="card shadow">
                    <div class="card-body">
                        <form action="msg.php" method="post">
                            <label for="receiver_id">Receiver ID:</label>
                            <select name="receiver_id" id="receiver_id" class="form-control">
    <?php
    $res = mysqli_query($conn, "SELECT * FROM reg_student");
    while ($row = mysqli_fetch_array($res)) {
        echo "<option value='" . $row["lid"] . "'>" . $row["lid"] . " - " . $row["name"] . "</option>";
    }
    ?>
</select><br><br>

                            <label for="message">Message:</label><br>
                            <textarea id="message" name="message" rows="4" cols="50"></textarea><br><br>

                            <input type="submit" value="Send Message">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
