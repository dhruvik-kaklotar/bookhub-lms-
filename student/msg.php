<?php 
include 'config.php';
include 'header.php';

// Check if the user is logged in
if (!isset($_SESSION['sloggedin'])) {
    // Redirect to the login page
    header("location: slogin.php");
    exit;
}
mysqli_query($conn, "UPDATE messages SET `KEY` = 'y' WHERE receiver_id = '$_SESSION[sloggedin]'");


?>
<style>
    .chat-container {
        max-width: 800px;
        margin: auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f9f9f9;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .message {
        margin: 10px 0;
        padding: 10px;
        border-radius: 5px;
        background-color: #fff;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .message.sender {
        text-align: right;
    }

    .message .meta {
        font-size: 12px;
        color: #999;
    }
</style>

<div class="chat-container">
    <?php
    // Assuming you have a database connection already established
    $receiverId = $_SESSION['sloggedin'];
    $sql = "SELECT * FROM messages WHERE receiver_id = '$receiverId' ORDER BY sent_at ASC";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $messageClass = ($row['sender_name'] == $_SESSION['sloggedin']) ? 'sender' : 'receiver';
        echo '<div class="message ' . $messageClass . '">';
echo '<p><strong>' . $row["sender_name"] . '</strong>: ' . $row["message"] . '</p>';
echo '<div class="meta">' . $row["sent_at"] . '</div>';
echo '</div>';

    }
    ?>
</div>
