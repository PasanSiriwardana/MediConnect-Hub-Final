<?php
include 'conf.php';

// Ensure the 'no' parameter is set and is not empty
if(isset($_GET['no']) && !empty($_GET['no'])) {
    // Sanitize the 'no' parameter to prevent SQL injection
    $no = mysqli_real_escape_string($conn, $_GET['no']);

    // Query to update the 'checked' status for the specific row
    $query = "UPDATE doc_report SET checked = 1 WHERE no='$no'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Return 1 for success
        echo '1';
    } else {
        // Return 0 for failure
        echo '0';
    }
    exit();
} else {
    // Return 0 if 'no' parameter is not provided
    echo '0';
    exit();
}
?>
