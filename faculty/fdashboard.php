<?php 
// include 'inc/config.php';
      include 'header.php';
      if (!isset($_SESSION['floggedin'])) {
        // Redirect to the login page
        header("location: flogin.php");
        exit;
    } ?>
  <section class="content" style="margin: 8px; margin-top:-50px" >
<div >  
 <div>
    <h1>&nbsp </h1>
    
</div>  
    
<div class="row">
<?php
// Execute SQL query to count unique lectures
$sql = "SELECT COUNT(DISTINCT date) AS total_lectures FROM attendance";
$result = mysqli_query($conn, $sql);

// Check if the query was successful and if there is at least one row returned
if ($result && mysqli_num_rows($result) > 0) {
    // Fetch the total number of lectures from the result
    $row = mysqli_fetch_assoc($result);
    $total_lectures = $row['total_lectures'];

    // Print the HTML structure with the total number of lectures
    echo '<div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-laptop-code"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Total Lectures</span>
                <span class="info-box-number">' . $total_lectures . '</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>';
} else {
    // Handle the case where no lectures are found
    echo '<div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-laptop-code"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Total Lectures</span>
                <span class="info-box-number">0</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>';
}
?>

          <!-- /.col -->
          <?php
// Execute SQL query to retrieve the data
$sql = "SELECT f.name AS faculty_name, f.coursename AS course_name, COUNT(cb.semlid) AS total_students
        FROM faculty f
        LEFT JOIN courcebooking cb ON f.coursename = cb.courcename
        GROUP BY f.name, f.coursename";
$result = mysqli_query($conn, $sql);

// Check if any rows are returned
if (mysqli_num_rows($result) > 0) {
    // Loop through each row of the result
    while ($row = mysqli_fetch_assoc($result)) {
        // Extract data from the row
        $faculty_name = $row['faculty_name'];
        $course_name = $row['course_name'];
        $total_students = $row['total_students'];

        // Print HTML for each course info box
        echo '<div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                  <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-user"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Students</span>
                    <span class="info-box-number">' . $total_students . '</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>';
    }
} else {
    // No data found
    echo "No courses found.";
}
?>

          
        </div>
        <!-- /.row -->
        </div> </div> 