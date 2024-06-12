<?php
include 'inc/config.php';
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['loggedin'])) {
    // Redirect to the login page
    header("location: admin login.php");
    exit;
}

// Fetching user information based on the logged-in username
$username = mysqli_real_escape_string($conn, $_SESSION['loggedin']);
$sql = "SELECT * FROM admin WHERE username='$username'";
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $img = $row['photo']; // Assuming 'photo' is the column name for the user's photo
} else {
    // Handle query error
    echo "Error: " . mysqli_error($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BookHub</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="dist/img/book.gif" alt="AdminLTELogo" height="60" width="60">
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
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
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

                <!-- Messages Dropdown Menu -->
                <!-- <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
             <!-- Message Start -->
                <!-- <div class="media">
              <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div> -->
                <!-- Message End -->
                <!-- </a>
         
      </li>   -->



                <!-- Notifications Dropdown Menu -->
                <!-- <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header"></span>
          
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 
            <span class="float-right text-muted text-sm"></span>
          </a> -->

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <!-- Add the 'dropdown' class -->
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user-circle"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <!-- Add the 'dropdown-menu' class -->
                        <!-- Dropdown items -->
                        <a class="dropdown-item" href="profile.php"><i class="fas fa-user-circle">&nbsp;</i>Profile</a>
                        <a class="dropdown-item" href="cp.php"><i class="fas fa-key">&nbsp;</i>Change password</a>
                        <a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt">&nbsp;</i>Logout</a>
                        <!-- <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#">Something else here</a> -->
                    </div>
                </li>


            </ul>
        </nav>
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="adashboard.php" class="brand-link" style="text-decoration: none;text-align:center;">
                <img src="logo.png" alt="BookHub" style="width: 62px;">
                <!-- <img src="logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
                <!-- <span class="brand-text font-weight-light">BookHub</span> -->
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-4 d-flex">
                    <div class="image">
                        <img src="<?php echo $img;?>" class="img-circle elevation-2" alt="User Image"
                            style="width:50px; height:50px">
                    </div>
                    <div class="info">
                        <?php
        if (isset($_SESSION['loggedin'])) {
          echo '<span style="color:white">Welcome</span><br>';
          echo ' <a href="#" class="" style="text-decoration:none;">&nbsp;' . $_SESSION['loggedin'] . '</a>';
        } else {
            echo '<a href="#" class="d-block">Guest</a>';
        }
        ?>
                    </div>
                </div>
                <!-- SidebarSearch Form -->




                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar" onclick="sidebarSearch()">
                                <script>
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
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item menu-open">
                            <a href="adashboard.php" class="nav-link active">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                    Dashboard

                                </p>
                            </a>

                            <!-- <li class="nav-item">
            <a href="pages/widgets.html" class="nav-link ">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Widgets
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li> -->
                        <li class="nav-item">
                            <a href="pages/widgets.html" class="nav-link">
                                <i class="nav-icon fas fa-user-circle"></i>
                                <p>
                                    Student
                                    <i class="fas fa-angle-left right"></i>

                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="ragistation.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Student registration </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="allstudent.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>All student</p>
                                    </a>
                                </li>
                            </ul>


                        <li class="nav-item">
                            <a href="pages/widgets.html" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Books
                                    <i class="fas fa-angle-left right"></i>

                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="allbooks.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>all Books </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="addbook.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add book</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="addbookcategorie.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add New Book categorie</p>
                                    </a>
                                </li>
                            </ul>
                        </li>


                        <li class="nav-item">
                            <a href="pages/widgets.html" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>
                                    Issue book
                                    <i class="fas fa-angle-left right"></i>

                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="newissuebook.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>new Isuue book </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="allissuedbook.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>all issue book</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="pages/widgets.html" class="nav-link">
                                <i class="nav-icon fas fa-rupee-sign"></i>
                                <p>
                                    Fine zone
                                    <i class="fas fa-angle-left right"></i>

                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="newfine.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>new fine</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pfine.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>pending fine</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="finerecord.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Fine record</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="pages/widgets.html" class="nav-link">
                                <i class="nav-icon fas fa-envelope"></i>
                                <p>
                                    Message zone
                                    <i class="fas fa-angle-left right"></i>

                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="msg.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>send MSG</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="allmsg.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>send NOTICE</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="pages/widgets.html" class="nav-link">
                                <i class="nav-icon fas fa-laptop-code"></i>
                                <p>
                                    cource zone
                                    <i class="fas fa-angle-left right"></i>

                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="cource.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>add cource</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="managec.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>manage cource</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="cstudent.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Applied student</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="creport.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>cource report</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="pages/widgets.html" class="nav-link">
                                <i class="nav-icon fas fa-user-graduate"></i>
                                <p>
                                    Faculty
                                    <i class="fas fa-angle-left right"></i>

                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="faculty.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Faculty Regestration </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="allfac.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>All faculty</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="booksell.php" class="nav-link ">
                                <i class="nav-icon fas fa-shopping-cart"></i>
                                <p>

                                    book selling

                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="icard.php" class="nav-link ">
                                <i class="nav-icon fas fa-id-card"></i>
                                <p>
                                    Icard

                                </p>
                            </a>
                        </li>

                        <!-- <li class="nav-item">
            <a href="faculty.php" class="nav-link ">
              <i class="nav-icon fas fa-user-graduate"></i>
              <p>
              Faculty
                
              </p>
            </a>
          </li> -->




                        <?php 
$res3 = mysqli_query($conn, "SELECT * FROM book_requests WHERE `key`='n'");

$knot = mysqli_num_rows($res3);

?>
                        <li class="nav-item">
                            <a href="requsted_book.php" class="nav-link ">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Book request
                                    <span class="right badge badge-danger"><?php echo $knot; ?></span>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="contact_details.php" class="nav-link ">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Contact Details
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="bot.php" class="nav-link ">
                                <i class="nav-icon fas fa-comment"></i>
                                <p>
                                    Chat Bot
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="admin_reviews.php" class="nav-link ">
                                <i class="nav-icon fas fa-star"></i>
                                <p>
                                    Books Reviews
                                </p>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Layout Options
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">6</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="profile.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Top Navigation</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Top Navigation + Sidebar</p>
                </a>
              </li> -->

                        <!--               
            </ul>
          </li> -->
                        <!-- Control Sidebar -->

                        <!-- Control sidebar content goes here -->
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
            <script src="plugins/jquery/jquery.min.js"></script>
            <!-- Bootstrap -->
            <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
            <!-- overlayScrollbars -->
            <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
            <!-- AdminLTE App -->
            <script src="dist/js/adminlte.js"></script>
            <script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
            <script src="plugins/raphael/raphael.min.js"></script>
            <script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
            <script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
            <script src="plugins/chart.js/Chart.min.js"></script>
</body>

</html>