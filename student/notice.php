<?php 
include 'header.php';
if (!isset($_SESSION['sloggedin'])) {
    // Redirect to the login page
    header("location: admin login.php");
    exit;
}
mysqli_query($conn, "UPDATE allmessages SET `KEY` = 'y'");

// Assuming you have a database connection already established
$receiverId = $_SESSION['sloggedin'];
$sql = "SELECT * FROM allmessages";
$result = mysqli_query($conn, $sql);
?>
<div>
    <h1>&nbsp;</h1>
</div>
<div class="container">
    <div class="card" >
        <div class="card-header">
            <h3>Messages</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Sender</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Attachment</th>
                            <th>Sent At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                            echo '<td>' . $row["sender_name"] . '</td>';
                            echo '<td>' . $row["subject"] . '</td>';
                            echo '<td>' . $row["message"] . '</td>';
                            echo '<td>';
                            if (!empty($row["attachment"])) {
                                echo '<a href="../uploads/' . $row["attachment"] . '">Download Attachment</a>';
                            } else {
                                echo 'No attachment';
                            }
                            echo '</td>';
                            echo '<td>' . $row["sent_at"] . '</td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
