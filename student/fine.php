<?php 
include 'config.php';
include 'header.php';

// Check if the user is logged in
if (!isset($_SESSION['sloggedin'])) {
    // Redirect to the login page
    header("location: slogin.php");
    exit;
}
$studname = $_SESSION['sloggedin']; 
    
    // Fetch data from pfine table
    $sql = "SELECT * FROM pfine WHERE library_id='$studname'";
    $result = $conn->query($sql);
    
    
    ?>
    <style>
        .table tbody td {
            vertical-align: middle;
        }
    </style>
    <!-- <body style=" background-image: url('2.jpg');"> -->
        
    
    <div>
        <h1>&nbsp;</h1>
        <h1>&nbsp;</h1>
    </div>
    
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Student Registration</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-sm mx-auto">
                                <thead>
                                    <tr>
                                        <th>Book id</th>
                                        <th>Student name</th>
                                        <th>Library id</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>fine date</th>
                                        <th>Issued date</th>
                                        <th>Return date</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row["bookid"] . "</td>";
                                            echo "<td>" . $row["student_name"] . "</td>";
                                            echo "<td>" . $row["library_id"] . "</td>";
                                            echo "<td>" . $row["email"] . "</td>";
                                            echo "<td>" . $row["phone"] . "</td>";
                                            echo "<td>" . date("d M Y", strtotime($row["fine_date"])) . "</td>";
                                            echo "<td>" . date("d M Y", strtotime($row["issued_date"])) . "</td>";
                                            echo "<td>" . date("d M Y", strtotime($row["return_date"])) . "</td>";
                                            
                                            echo "<td>" . $row["amount"] . "</td>";
                                            
                                        }
                                    } else {
                                        echo "0 results";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </body>