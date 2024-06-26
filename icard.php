<?php
//session_start();
include 'header.php';
if (!isset($_SESSION['loggedin'])) {
   
    header("location: slogin.php");
    exit;
} 
?>

<div>  
 <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Student I-card</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="adashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Student I-card</li>
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
    <title>Student Information</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div>
        <h6>&nbsp;</h6>
    </div>
<div class="container mt-5">
    <?php
    

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch data from the 'reg_student' table
    $sql = "SELECT * FROM reg_student";
    $result = $conn->query($sql);

    // Check if any rows were returned
    if ($result->num_rows > 0) {
        $count = 0;
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            if ($count % 3 == 0) {
                // Start a new row after every three columns
                echo '<div class="row">';
            }
            echo '<div class="col-12 col-sm-6 col-md-4 mb-3">';
            echo '<div class="card bg-light h-100">';
            echo '<div class="card-header text-muted border-bottom-0">';
            echo  "<h4>Name : ".$row["name"]."</h4> ";
            echo '</div>';
            echo '<div class="card-body pt-0">';
            echo '<b>' ."Department : ". $row["dept"] . '</b>';
            echo '<p class="text-sm"><b>Library ID : ' . $row["lid"] . '</b></p>';
            echo '<ul class="ml-4 mb-0 fa-ul text-muted">';
            echo '<li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: ' . $row["address"] . '</li>';
            echo '<li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: ' . $row["phone"] . '</li>';
            echo '</ul>';
            echo '</div>';
            echo '<div class="card-footer">';
            echo '<div class="text-right">';
            echo '<a href="msg.php" class="btn btn-sm bg-teal">';
            echo '<i class="fas fa-comments"></i> Message';
            echo '</a>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            $count++;
            if ($count % 3 == 0) {
                // Close the row after every three columns
                echo '</div>';
            }
        }
    } else {
        echo "0 results";
    }

    // Close the connection
    $conn->close();
    ?>
</div> <!-- .container -->
</body>
</html>
