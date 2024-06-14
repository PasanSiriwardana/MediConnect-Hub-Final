<?php
require 'conf.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $don_id = mysqli_real_escape_string($conn, $_POST['id']);
    $don_name = mysqli_real_escape_string($conn, $_POST['name']);
    $don_donation_id = mysqli_real_escape_string($conn, $_POST['donation_id']);
    $don_place = mysqli_real_escape_string($conn, $_POST['place']);
    $don_datetime = date("Y-m-d H:i:s");

    // Attempt insert query execution
    $sql = "INSERT INTO donations (don_id, don_name, don_donation_id, don_place, don_datetime) 
            VALUES ('$don_id', '$don_name', '$don_donation_id', '$don_place', '$don_datetime')";
    if (mysqli_query($conn, $sql)) {
        // Increment bu_donate_count in blood_user table
        $updateSql = "UPDATE blood_user SET bu_donate_count = bu_donate_count + 1 WHERE bu_id = '$don_id'";
        if (mysqli_query($conn, $updateSql)) {
            // Redirect to scanned.php with the id
            header("Location: scanned.php?id=$don_id");
            exit();
        } else {
            echo "Error updating donation count: " . mysqli_error($conn);
        }
    } else {
        echo "Error inserting donation: " . mysqli_error($conn);
    }
}

// Close connection
mysqli_close($conn);
?>
