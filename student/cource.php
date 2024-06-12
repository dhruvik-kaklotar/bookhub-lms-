<?php 
include 'config.php';
include 'header.php';

// Check if the user is logged in
if (!isset($_SESSION['sloggedin'])) {
    // Redirect to the login page
    header("location: slogin.php");
    exit;
}

$sql = "SELECT * FROM reg_student where lid=$_SESSION[sloggedin]";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $lname = $row["name"];
        $lid = $row["lid"];
        $semial = $row["email"];
    }
}

$sql = "SELECT * FROM course";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Application</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <?php
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $courcid = $row['courcid'];
                $courcename = $row['courcename'];
                $img = $row['img'];
                $description = $row['description'];
                $duration = $row['duration'];
                $fee = $row['fee'];
                $date = $row['date'];
                $faculty = $row['faculty'];
                ?>
                <div class="col-lg-8 mb-4">
                    <div class="card">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="../<?php echo $img; ?>" alt="course" class="card-img" style="height:300px; width:340px; margin-top:15px;margin-left:15px">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body" style="margin-left: 150px;">
                                    <h2 class="card-title"><?php echo $courcename; ?></h2>
                                    <p class="card-text"><strong>Description:</strong> <?php echo $description; ?></p>
                                    <p class="card-text"><strong>Duration:</strong> <?php echo $duration; ?></p>
                                    <p class="card-text"><strong>Fees:</strong> <?php echo $fee; ?></p>
                                    <p class="card-text"><strong>Date:</strong> <?php echo $date; ?></p>
                                    <p class="card-text"><strong>Faculty:</strong> <?php echo $faculty; ?></p>
                                    <button class="btn btn-success apply-now" data-toggle="modal" data-target="#applyModal" data-courcid="<?php echo $courcid; ?>"
                                            data-courcename="<?php echo $courcename; ?>" data-fee="<?php echo $fee; ?>" data-duration="<?php echo $duration; ?>"><strong>Apply Now</strong></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
        } else {
            echo "No courses found.";
        }
        ?>
    </div>
</div>

<!-- Apply Modal -->
<div class="modal fade" id="applyModal" tabindex="-1" role="dialog" aria-labelledby="applyModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Apply Now</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="applyForm" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="sname">Lid:</label>
                        <input type="text" class="form-control" id="sname" name="sname" value="<?php echo
                     $lid; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="sname">Name:</label>
                        <input type="text" class="form-control" id="sname" name="sname" value="<?php echo $lname; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="semail">Email:</label>
                        <input type="email" class="form-control" id="semail" name="semail" value="<?php echo $semial; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="courcename">Course Name:</label>
                        <input type="text" class="form-control" id="courcename" name="courcename" readonly>
                    </div>
                    <div class="form-group">
                        <label for="apply_date">Apply Date:</label>
                        <input type="text" class="form-control" id="apply_date" name="apply_date" readonly>
                    </div>
                    <div class="form-group">
                        <label for="fee">Fee:</label>
                        <input type="text" class="form-control" id="fee" name="fee" readonly>
                    </div>
                    <div class="form-group">
                        <label for="duration">Duration:</label>
                        <input type="text" class="form-control" id="duration" name="duration" readonly>
                    </div>
                    <input type="hidden" id="courcid" name="courcid">
                    <button type="submit" name="apply" class="btn btn-primary">Apply</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['apply'])) {
    $sname = $_POST['sname'];
    $semail = $_POST['semail'];
    $semlid = $lid; // Assuming $lid is the logged-in user's ID
    $courcename = $_POST['courcename'];
    $apply_date = $_POST['apply_date'];
    $fee = $_POST['fee'];
    $duration = $_POST['duration'];
    
    $sql = "INSERT INTO courcebooking (sname, semail, semlid, courcename, apply_date, fee, duration) VALUES ('$sname', '$semail', '$semlid', '$courcename', '$apply_date', '$fee', '$duration')";
    
    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Application submitted successfully!");</script>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!-- jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
        $('.apply-now').click(function() {
            var courcid = $(this).data('courcid');

            // Fetch student information via Ajax
            $.ajax({
                url: 'fetch_student_info.php', // Replace with your PHP file to fetch student info
                type: 'POST',
                dataType: 'json',
                success: function(response) {
                    $('#sname').val(response.sname);
                    $('#semail').val(response.semail);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });

            // Populate course information
            var courcename = $(this).data('courcename');
            var apply_date = new Date().toISOString().slice(0, 10); // Current date
            var fee = $(this).data('fee');
            var duration = $(this).data('duration');

            $('#courcename').val(courcename);
            $('#apply_date').val(apply_date);
            $('#fee').val(fee);
            $('#duration').val(duration);
            $('#courcid').val(courcid);
        });
    });
</script>

</body>
</html>
