<?php
include '../inc/config.php';
session_start();
error_reporting(0);

// Check if the user is not logged in
if (!isset($_SESSION['floggedin'])) {
    // Redirect to the login page
    header("location:flogin.php");
    exit;


    
}

$re = "SELECT * from faculty where fid=$_SESSION[floggedin]" ;
$res = mysqli_query($conn,$re);
$row = mysqli_fetch_assoc($res);
$Name = $row['name'];
$photo= $row['img'];


$username = mysqli_real_escape_string($conn, $_SESSION['loggedin']);
$sql = "SELECT * from faculty where fid=$_SESSION[floggedin]" ;

$result = mysqli_query($conn, $sql);

// Check if the query was successful
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $img = $row['img']; 
    $Name = $row['name'];// Assuming 'photo' is the column name for the user's photo
} else {
    // Handle query error
    echo "Error: " . mysqli_error($conn);
}
?>
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BookHub</title>
  
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="../dist/img/book.gif" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      
          
         
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item dropdown"> <!-- Add the 'dropdown' class -->
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-user-circle"></i>
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown"> <!-- Add the 'dropdown-menu' class -->
        <!-- Dropdown items -->
        <a class="dropdown-item" href="profile.php"><i class="fas fa-user-circle">&nbsp;</i>Profile</a>
        <a class="dropdown-item" href="cp.php"><i class="fas fa-key">&nbsp;</i>Change password</a>
        <a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt">&nbsp;</i>Logout</a>
        
    </div>
</li>

      
    </ul>
  </nav>
  <!-- /.navbar -->
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="fdashboard.php" class="brand-link" style="text-decoration:none;text-align:center;">
    <img src="../logo.png" alt="BookHub" style="width: 62px;"> 
      <!-- <img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">BookHub</span> -->
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
     <!-- Sidebar user panel (optional) -->
<div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
    <img src="<?php echo $img;?>" class="img-circle elevation-2" alt="User Image" style="width:50px; height:50px">
    </div>
    <div class="info">
        <?php
        if (isset($_SESSION['floggedin'])) {
          echo '<span style="color:white">Welcome</span><br>';
          echo ' <a href="#" class="" style="text-decoration:none;">&nbsp;' . $Name . '</a>';
        } else {
            echo '<a href="#" class="d-block">Guest</a>';
        }
        ?>
    </div>
</div>
     
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar" onclick="sidebarSearch()"><script>
function sidebarSearch() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("sidebar-search-input");
    filter = input.value.toUpperCase();
    ul = document.querySelector(".nav-sidebar");
    li = ul.querySelectorAll("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].querySelector("a.nav-link");
        p = li[i].querySelector("p");
        txtValue = p ? p.textContent || p.innerText : "";
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}
</script>

              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="fdashboard.php" class="nav-link active">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Dashboard
                
              </p>
            </a>
           
          <li class="nav-item">
            <a href="student.php" class="nav-link ">
              <i class="nav-icon fas fa-user"></i>
              <p>
                My student
                
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="attendence.php" class="nav-link ">
              <i class="nav-icon fas fa-check-circle"></i>
              <p>
                attendence
                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../bot.php" class="nav-link ">
              <i class="nav-icon fas fa-comment"></i>
              <p>
                Chat Bot
                
              </p>
            </a>
          </li>
         
          
  </aside>
  <!-- /.control-sidebar -->
<!-- Content Wrapper. Contains page content -->
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
   
    <!-- /.content-header -->
<div>
<!-- ./wrapper -->
<aside class="control-sidebar control-sidebar-light primary">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="../plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="../plugins/raphael/raphael.min.js"></script>
<script src="../plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="../plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="../plugins/chart.js/Chart.min.js"></script>

</body>
</html>
