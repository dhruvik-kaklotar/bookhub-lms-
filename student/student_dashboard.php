<?php include 'config.php';
      include 'header.php';
      if (!isset($_SESSION['sloggedin'])) {
        // Redirect to the login page
        header("location: slogin.php");
        exit;
    } 
    $specific_student_email = $_SESSION['sloggedin'];
    ?>
<section class="content" style="margin: 8px;">
    <div>
        <div>
            <h1>&nbsp </h1>

        </div>

        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user"></i></span>

                    <?php       
                        $result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM reg_student");
                        $row = mysqli_fetch_assoc($result);
                        $totalStudents = $row['total'];
                    ?>
                    <div class="info-box-content">
                        <span class="info-box-text">Student</span>
                        <span class="info-box-number">
                            <?php echo $totalStudents; ?>

                        </span>
                    </div>

                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <?php
          $specific_student_email = $_SESSION['sloggedin'];
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
            }
              // Calculate the attendance percentage
              $attendancePercentage = ($totalRecords > 0) ? (($presentRecords / $totalRecords) * 100) : 0;
          
          
          ?>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Attendence</span>
                        <?php echo "<span class='info-box-number'>" . number_format($attendancePercentage, 2) . "%</span>";?>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-book"></i></span>

                    <?php       
                        $result1 = mysqli_query($conn, "SELECT COUNT(*) AS total_purchase FROM orders WHERE lid = '$specific_student_email'");
                        $row1 = mysqli_fetch_assoc($result1);
                        $total_purchase = $row1['total_purchase'];
                    ?>
                    <div class="info-box-content">
                        <span class="info-box-text">Purchase Book</span>
                        <span class="info-box-number">
                            <?php echo $total_purchase; ?>

                        </span>
                    </div>

                    <!-- /.info-box-content -->
                </div>
          </div>
          <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                    <?php       
                        $result2 = mysqli_query($conn, "SELECT COUNT(*) AS total_courcebooking FROM courcebooking WHERE semlid = '$specific_student_email'");
                        $row2 = mysqli_fetch_assoc($result2);
                        $total_courcebooking = $row2['total_courcebooking'];
                    ?>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Courcebooking</span>
                        <span class="info-box-number">
                            <?php echo $total_courcebooking; ?>

                        </span>
                    </div>

                    <!-- /.info-box-content -->
                </div>
          </div>
          <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-book"></i></span>

                    <?php       
                        $result3 = mysqli_query($conn, "SELECT COUNT(*) AS total_issuebooks FROM issurecord WHERE lid = '$specific_student_email'");
                        $row3 = mysqli_fetch_assoc($result3);
                        $total_issuebooks = $row3['total_issuebooks'];
                    ?>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Isuue Books</span>
                        <span class="info-box-number">
                            <?php echo $total_issuebooks; ?>

                        </span>
                    </div>

                    <!-- /.info-box-content -->
                </div>
          </div>
          <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-rupee-sign "></i></span>

                    <?php       
                         $result4 = mysqli_query($conn, "SELECT SUM(amount) AS total_fine FROM finerecod WHERE library_id = '$specific_student_email';");
                         $row4 = mysqli_fetch_assoc($result4);
                         $total_fine = $row4['total_fine'];
                    ?>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Fine</span>
                        <span class="info-box-number">
                            <?php echo $total_fine; ?>

                        </span>
                    </div>

                    <!-- /.info-box-content -->
                </div>
          </div>
            <div class="clearfix hidden-md-up"></div>