<?php
include 'header.php';
if (!isset($_SESSION['floggedin'])) {
    // Redirect to the login page
    header("location: flogin.php");
    exit; // Exit script to prevent further execution
}

// Default status is absent
$status = 'absent';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve student IDs, attendance status, teaching topic, and report from the form
    $studentIds = $_POST['student_ids'];
    $date = date('Y-m-d');
    $specific_course_name = ""; // Initialize specific course name variable
    
    // Fetch the course name from the form submission (assuming it's sent as a hidden input)
    if(isset($_POST['course_name'])) {
        $specific_course_name = $_POST['course_name'];
    }
    
    // Loop through each student ID and insert attendance data into the database
    foreach ($studentIds as $studentId) {
        // Retrieve the attendance status for the current student
        $attendanceStatus = isset($_POST['attendance_' . $studentId]) ? $_POST['attendance_' . $studentId] : 'absent';
        
        // Determine the status based on the attendance form input
        if($attendanceStatus === 'Present') {
            $status = 'present';
        } else {
            $status = 'absent';   
        }
        
        // Retrieve teaching topic and report
        //$teachingTopic = $_POST['teaching_topic'];
        $report = $_POST['teaching_topic'];
        
        // Insert attendance data into the database including course name, teaching topic, and report
        $sql = "INSERT INTO attendance (coursename, student_id, date, status,  report) VALUES ('$specific_course_name', '$studentId', '$date', '$status', '$report')";
        mysqli_query($conn, $sql);
    }
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
    // Fetch the first row to get the course name
    $row = mysqli_fetch_assoc($result);
    $specific_course_name = $row['courcename'];

    // Display the attendance form
    echo "<div class='container mt-5'>";
    echo "<h2>$specific_course_name</h2>"; // Display the course name
    echo "<form action='attendence.php' method='post'>";
    echo "<input type='hidden' name='course_name' value='$specific_course_name'>"; // Add hidden input for course name
    echo "<div class='row'>";

    // Fetch and display each row of the result
    mysqli_data_seek($result, 0); // Reset the result pointer to the beginning
    while ($row = mysqli_fetch_assoc($result)) {
        // Set card color based on attendance status
        $cardColor = ($row['status'] == 'present') ? 'bg-success' : 'bg-danger';

        echo "<div class='col-md-3' style='margin-top:50px; margin-left:5px'>";
        echo "<div class='card mb-3 $cardColor'>";
        echo "<div class='card-body'>";
        echo "<h5 class='card-title'>" . $row["sname"] . "</h5>";
        echo "<p class='card-text'>Library ID: " . $row["semlid"] . "</p>";
        // Add a hidden input field to pass student IDs
        echo "<input type='hidden' name='student_ids[]' value='" . $row['semlid'] . "'>";
        // Add a checkbox for marking attendance
        echo "<div class='form-group'>";
        $checked = ($row['status'] == 'present') ? 'checked' : '';
        echo "<input type='checkbox' id='attendance_" . $row['semlid'] . "' name='attendance_" . $row['semlid'] . "' value='Present' $checked>";
        echo "<label for='attendance_" . $row['semlid'] . "' style='color:white;'></label>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }

    // Add input field for teaching topic
    echo "<div class='col-md-6 offset-md-0.5'>";
    echo "<div class='form-group'>";
    echo "<label for='teaching_topic'>Teaching Topic:</label>";
    echo "<input type='text' class='form-control' id='teaching_topic' name='teaching_topic'>";
    echo "</div>";
    echo "</div>";

    // Add input field for report
  

    // Close the form
    echo "</div>";
    echo "<button type='submit' class='btn btn-primary' style=' margin-left:5px'>Submit Attendance</button>";
    echo "</form>";
    echo "</div>";
}
?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    
    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            const card = this.closest('.card');
            if (this.checked) {
                card.classList.remove('bg-danger');
                card.classList.add('bg-success');
            } else {
                card.classList.remove('bg-success');
                card.classList.add('bg-danger');
            }
        });
    });
});
</script>
