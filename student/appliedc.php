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

// Initialize search query variable
$search_query = "";

// Check if search query is set
if (isset($_GET['search'])) {
    // Sanitize the search query
    $search_query = mysqli_real_escape_string($conn, $_GET['search']);
}

// SQL query to select student data with optional search filter
$sql = "SELECT * FROM courcebooking WHERE semlid = '$specific_student_email'";
if (!empty($search_query)) {
    $sql .= " AND courcename LIKE '%$search_query%'";
}

// Execute the query
$result = mysqli_query($conn, $sql);

// Check if there are any records
if (mysqli_num_rows($result) > 0) {
    // Display the search bar
    echo "<div class='container mt-3'>
    <div><h1>&nbsp;</h1></div>";
    echo "<form method='GET'>";
echo "<div class='input-group input-group-sm mb-3'>";
echo "<input type='text' class='form-control form-control-sm' id='searchInput' name='search' value='$search_query' placeholder='Search for Course...'>";
echo "<div class='input-group-append'>";
echo "<button class='btn btn-outline-secondary' type='submit'><i class='fas fa-search'></i></button>";
echo "</div>";
echo "</div>";
echo "</form>";
echo "</div>";

    // Display the table headers
    echo "<div class='container'>";
    echo "<table class='table table-bordered'>";
    echo "<thead class='thead-dark'><tr><th>Course ID</th><th>Email</th><th>Library ID</th><th>Course Name</th><th>Apply Date</th><th>Fee</th><th>Duration</th></tr></thead>";
    echo "<tbody>";

    // Fetch and display each row of the result
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["cource_id"] . "</td>";
        echo "<td>" . $row["semail"] . "</td>";
        echo "<td>" . $row["semlid"] . "</td>";
        echo "<td>" . $row["courcename"] . "</td>";
        echo "<td>" . $row["apply_date"] . "</td>";
        echo "<td>" . $row["fee"] . "</td>";
        echo "<td>" . $row["duration"] . "</td>";
        echo "</tr>";
    }

    // Close the table
    echo "</tbody>";
    echo "</table>";
    echo "</div>";
} else {
    echo "No records found";
}

// Close the database connection
mysqli_close($conn);
?>

<script>
    // Add an event listener to the search input field
    document.getElementById("searchInput").addEventListener("input", function() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = this;
        filter = input.value.toUpperCase();
        table = document.querySelector(".table");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[3]; // Index of the "Course Name" column
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    });
</script>
