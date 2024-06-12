<?php
if(isset($_POST['cid'])){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bookhub__2_";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $cid = $_POST['cid'];
    $sql = "DELETE FROM reg_student WHERE cid='$cid'";
    if ($conn->query($sql) === TRUE) {
      echo "Record deleted successfully";
    } else {
      echo "Error deleting record: " . $conn->error;
    }

    $conn->close();
}
?>
