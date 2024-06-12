<?php
include 'header.php';
if (!isset($_SESSION['floggedin'])) {
    // Redirect to the login page
    header("location: flogin.php");
    exit; // Exit script to prevent further execution
}

// Assuming you have already established a database connection

// Define the specific teacher's Faculty ID
$specific_teacher_fid = $_SESSION['floggedin'];

// SQL query to select students and the teacher's information for the specific course
$sql = "SELECT cb.*, f.name AS teacher_name, f.email AS teacher_email FROM courcebooking cb INNER JOIN faculty f ON cb.courcename = f.coursename WHERE f.fid = $specific_teacher_fid";

// Execute the query
$result = mysqli_query($conn, $sql);

// Check if there are any records
if (mysqli_num_rows($result) > 0) {
    // Display the table headers
    echo "<div class='container mt-5'>";
    echo "<table class='table table-bordered'>";
    echo "<thead class='thead-dark'><tr><th>Course ID</th><th>Student Name</th><th>Student Email</th><th>Student Library ID</th><th>Course Name</th><th>Apply Date</th><th>Fee</th><th>Duration</th></tr></thead>";
    echo "<tbody>";

    // Fetch and display each row of the result
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["cource_id"] . "</td>";
        echo "<td>" . $row["sname"] . "</td>";
        echo "<td>" . $row["semail"] . "</td>";
        echo "<td>" . $row["semlid"] . "</td>";
        echo "<td>" . $row["courcename"] . "</td>";
        echo "<td>" . $row["apply_date"] . "</td>";
        echo "<td>" . $row["fee"] . "</td>";
        echo "<td>" . $row["duration"] . "</td>";
        echo "</tr>";
    }

    // Close the table body and table
    echo "</tbody></table>";
    echo "</div>"; // Close container
} else {
    echo "<div class='container mt-5'>";
    echo "No records found";
    echo "</div>"; // Close container
}


?>
