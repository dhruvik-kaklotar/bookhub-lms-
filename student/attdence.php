<?php
include 'header.php';
if (!isset($_SESSION['sloggedin'])) {
    // Redirect to the login page
    header("location: slogin.php");
    exit; // Exit script to prevent further execution
}

// Assuming you have already established a database connection

// Define the specific student's email
$specific_student_email = $_SESSION['sloggedin'];

// SQL query to select attendance data for the specific student
$sql = "SELECT * FROM attendance WHERE student_id = '$specific_student_email'";

// Execute the query
$result = mysqli_query($conn, $sql);

// Initialize variables to count total attendance records and present records
$totalRecords = 0;
$presentRecords = 0;

// Check if there are any records
if (mysqli_num_rows($result) > 0) {
    // Loop through each row of the result
    while ($row = mysqli_fetch_assoc($result)) {
        // Increment the total records count
        $totalRecords++;
        
        // Check if the status is 'present'
        if ($row["status"] == "present") {
            // If present, increment the present records count
            $presentRecords++;
        }
    }

    // Calculate the attendance percentage
    $attendancePercentage = ($totalRecords > 0) ? (($presentRecords / $totalRecords) * 100) : 0;

    // Display the attendance percentage
    echo "<div class='container mt-5'><div><h1>&nbsp;</h1></div>";
    echo "<h3>Attendance Percentage: " . number_format($attendancePercentage, 2) . "%</h3>";
    echo "</div>";

    // Display the table headers
    echo "<div class='container mt-3'>";
    echo "<table class='table table-bordered'>";
    echo "<thead class='thead-yellow'><tr><th>Course Name</th><th>Date</th><th>Status</th></tr></thead>";
    echo "<tbody>";

    // Reset the result pointer to display the records again
    mysqli_data_seek($result, 0);

    // Fetch and display each row of the result
    while ($row = mysqli_fetch_assoc($result)) {
        // Set row background color based on attendance status
        $rowColor = ($row['status'] == 'absent') ? 'style="background-color: #cd3f4c;"' : '';

        echo "<tr $rowColor>";
        echo "<td>" . $row["coursename"] . "</td>";
        echo "<td>" . $row["date"] . "</td>";
        echo "<td>" . $row["status"] . "</td>";
        echo "</tr>";
    }

    // Close the table
    echo "</tbody>";
    echo "</table>";
    echo "</div>";
} else {
    echo "<div class='container mt-5'>";
    echo "<p>No attendance records found</p>";
    echo "</div>";
}

// Close the database connection
mysqli_close($conn);
?>
