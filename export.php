<?php
// Start session if not already started
session_start();

// Check if user is logged in
if (!isset($_SESSION['loggedin'])) {
    // Redirect to the login page
    header("location: admin login.php");
    exit;
}

// Include database connection and header file
include 'inc/config.php';

// Fetch data from the 'orders' table
$sql = "SELECT * FROM orders";
$result = $conn->query($sql);

// Create an empty array to store the report data
$reportData = array();

// Check if any rows were returned
if ($result->num_rows > 0) {
    // Add column headers to the report data
    $reportData[] = array("Order ID", "Book ID", "Date", "Student Name", "LID", "Address", "Contact", "Book Name", "Author Name", "Price");

    // Loop through each row of the result set and add data to the report
    while ($row = $result->fetch_assoc()) {
        // Add row data to the report data array
        $reportData[] = array(
            $row["order_id"],
            $row["product_id"],
            $row["date"],
            $row["studentname"],
            $row["lid"],
            $row["address"],
            $row["contact"],
            $row["bookname"],
            $row["author"],
            $row["price"]
        );
    }

    // Include PhpSpreadsheet library
    require 'vendor/autoload.php';

    // Create new Spreadsheet object
    $spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();

    // Set report data to active sheet
    $spreadsheet->getActiveSheet()->fromArray($reportData, null, 'A1');

    // Create Excel writer object
    $writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

    // Set appropriate headers for file download
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="book_sold_report.xlsx"');
    header('Cache-Control: max-age=0');

    // Write the Excel file to output
    $writer->save('php://output');
    exit;
} else {
    // No data found in the 'orders' table
    echo "No results found.";
}
?>
