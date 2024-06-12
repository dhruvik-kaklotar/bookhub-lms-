<?php
include 'header.php'; // Assuming this file contains the necessary configurations and session handling
if (!isset($_SESSION['loggedin'])) {
    // Redirect to the login page
    header("location: admin_login.php");
    exit;
}

$userId = 'user_id'; // Replace 'user_id' with the actual user ID
$sql = "SELECT * FROM messages WHERE receiver_id = '$userId'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<h2>Messages:</h2>";
    echo "<ul>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<li><strong>From:</strong> " . $row["sender_id"] . " <strong>Message:</strong> " . $row["message"] . "</li>";
    }
    echo "</ul>";
} else {
    echo "No messages found.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Messages</title>
    <style>
        .notification {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: red;
            color: white;
            border-radius: 50%;
            padding: 5px 10px;
            font-size: 12px;
            display: none;
        }
    </style>
</head>
<body>
    <div class="notification" id="notification">0</div>
    <button onclick="showMessages()">Show Messages</button>

    <script>
        let newMessages = 0;

        function showMessages() {
            document.getElementById('notification').style.display = 'none';
            // Code to show messages
            alert("Showing messages...");
        }

        // Simulate receiving new messages
        function receiveMessages() {
            newMessages++;
            document.getElementById('notification').innerText = newMessages;
            document.getElementById('notification').style.display = 'block';
        }

        // Call receiveMessages() when a new message is received (for demonstration purposes)
        setInterval(receiveMessages, 3000); // Simulate receiving new messages every 3 seconds
    </script>
</body>
</html>
