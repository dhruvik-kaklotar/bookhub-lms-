<?php include 'inc/config.php';
      include 'header.php';
      if (!isset($_SESSION['loggedin'])) {
        // Redirect to the login page
        header("location: admin login.php");
        exit;
    } ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
.pia_books{
  text-align:center;
}
.pia_books canvas{
  display: inline !important;
}
</style>
<section class="content" style="margin: 8px;">
    <div>
        <div>
            <h1>&nbsp </h1>

        </div>

        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                    <?php
     
    $result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM reg_student");
    $row = mysqli_fetch_assoc($result);
    $totalStudents = $row['total'];

    $result1 = mysqli_query($conn, "SELECT COUNT(*) AS total FROM course");
    $row1 = mysqli_fetch_assoc($result1);
    $totalcourse = $row1['total'];

    $result2 = mysqli_query($conn, "SELECT COUNT(*) AS total FROM orders");
    $row2 = mysqli_fetch_assoc($result2);
    $totalorders = $row2['total'];

    $result3 = mysqli_query($conn, "SELECT COUNT(*) AS total FROM courcebooking");
    $row3 = mysqli_fetch_assoc($result3);
    $cb = $row3['total'];

    $result3 = mysqli_query($conn, "SELECT SUM(amount) AS total_amount FROM finerecod;");
    $row3 = mysqli_fetch_assoc($result3);
    $fine = $row3['total_amount'];

    $result4 = mysqli_query($conn, "SELECT COUNT(*) AS total FROM books");
    $row4 = mysqli_fetch_assoc($result4);
    $books = $row4['total'];

    $result5 = mysqli_query($conn, "SELECT COUNT(*) AS total FROM book_requests");
    $row5 = mysqli_fetch_assoc($result5);
    $rb = $row5['total'];

    $result6 = mysqli_query($conn, "SELECT COUNT(*) AS total FROM issuedbook");
    $row6 = mysqli_fetch_assoc($result6);
    $eb = $row6['total'];

    $result7 = mysqli_query($conn, "SELECT COUNT(*) AS total FROM contact");
    $row7 = mysqli_fetch_assoc($result7);
    $per_con = $row6['total'];
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
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-laptop-code"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Courses</span>
                        <span class="info-box-number"><?php echo $totalcourse;?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Books sold</span>
                        <span class="info-box-number"><?php echo $totalorders;?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Student pursing course </span>
                        <span class="info-box-number"><?php echo $cb;?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>



            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-rupee-sign"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total fine</span>
                        <span class="info-box-number"><?php echo $fine;?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fas fa-book"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total books</span>
                        <span class="info-box-number"><?php echo $books;?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>


            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fas fa-book"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Requested books</span>
                        <span class="info-box-number"><?php echo $rb;?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>


            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fas fa-book"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Issued books</span>
                        <span class="info-box-number"><?php echo $eb;?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fas fa-male"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Contact List</span>
                        <span class="info-box-number"><?php echo $per_con;?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
<hr>
 <div class="pia_books">   
  <h2>Books Report</h2>
    <canvas id="pieChart" width="400" height="400"></canvas>

    <?php
     $result8 = mysqli_query($conn, "SELECT COUNT(*) AS total_books FROM books;");
     $row8 = mysqli_fetch_assoc($result8);
     $totalBooks = $row8['total_books'];

     $result9 = mysqli_query($conn, "SELECT COUNT(*) AS sold_books FROM orders;");
     $row9 = mysqli_fetch_assoc($result9);
     $soldBooks = $row9['sold_books'];

     $result10 = mysqli_query($conn, "SELECT COUNT(*) AS issuedbook_books FROM issuedbook;");
     $row10 = mysqli_fetch_assoc($result10);
     $issuedBooks = $row10['issuedbook_books'];

    // $issuedBooks = 20;
    ?>

    <script>
    // Retrieve data from PHP variables
    var totalBooks = <?php echo $totalBooks; ?>;
    var soldBooks = <?php echo $soldBooks; ?>;
    var issuedBooks = <?php echo $issuedBooks; ?>;

    // Create pie chart
    var ctx = document.getElementById('pieChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Total Books', 'Sold Books', 'Issued Books'],
            datasets: [{
                label: '# of Books',
                data: [totalBooks, soldBooks, issuedBooks],
                backgroundColor: [
                    'rgba(109,168,69, 0.5)', // Total Books
                    'rgba(230,121,47, 0.5)', // Sold Books
                    'rgba(247,186,0, 0.5)'  // Issued Books
                ],
                borderColor: [
                    'rgba(109,168,69, 1)',
                    'rgba(230,121,47, 1)',
                    'rgba(247,186,0, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: false
        }
    });
    </script>
    </div>
    <hr>
    <div class="pia_books">   
  <h2>Users Report</h2>
    <canvas id="pieChart1" width="400" height="400"></canvas>

    <?php
     $result11 = mysqli_query($conn, "SELECT COUNT(*) AS total_admin FROM admin;");
     $row11 = mysqli_fetch_assoc($result11);
     $totaladmin = $row11['total_admin'];

     $result12 = mysqli_query($conn, "SELECT COUNT(*) AS total_staff FROM faculty;");
     $row12 = mysqli_fetch_assoc($result12);
     $total_staff = $row12['total_staff'];

     $result13 = mysqli_query($conn, "SELECT COUNT(*) AS total_student FROM reg_student;");
     $row13 = mysqli_fetch_assoc($result13);
     $total_student = $row13['total_student'];

    // $issuedBooks = 20;
    ?>

    <script>
    // Retrieve data from PHP variables
    var totaladmin = <?php echo $totaladmin; ?>;
    var total_staff = <?php echo $total_staff; ?>;
    var total_student = <?php echo $total_student; ?>;

    // Create pie chart
    var ctx = document.getElementById('pieChart1').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Total Admin', 'Total Staff', 'Total Student'],
            datasets: [{
                label: '# of Books',
                data: [totaladmin, total_staff, total_student],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)', // Total Books
                    'rgba(54, 162, 235, 0.5)', // Sold Books
                    'rgba(255, 206, 86, 0.5)'  // Issued Books
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: false
        }
    });
    </script>
    </div>
