<?php
session_start();
require 'connection.php';

// Check if the user is logged in
if (!isset($_SESSION['usr'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['usr'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Update user information based on the submitted form data
    $new_name = $_POST['name'];
    $new_age = $_POST['age'];
    $new_phone = $_POST['phone'];
    $new_city = $_POST['city'];
    $new_state = $_POST['state'];
    $new_donate_count = $_POST['donate_count'];
    $new_donate_date = $_POST['donate_date'];
    $new_like_to_donate = $_POST['like_to_donate'];
    $new_long_term_illness = $_POST['long_term_illness'];
    $new_discribe_illness = $_POST['discribe_illness'];
    $new_taking_any_medicine = $_POST['taking_any_medicine'];
    $new_discribe_medicine = $_POST['discribe_medicine'];
    $new_undergone_any_surgery = $_POST['undergone_any_surgery'];
    $new_discribe_surgery = $_POST['discribe_surgery'];

    // Update SQL query accordingly (use prepared statements for security)
    Database::iud("UPDATE blood_user SET bu_name='$new_name', bu_age='$new_age', bu_phone='$new_phone', bu_city='$new_city', bu_state='$new_state', 
    bu_donate_count='$new_donate_count', bu_donate_date='$new_donate_date', bu_like_to_donate='$new_like_to_donate', 
    bu_long_term_illness='$new_long_term_illness', bu_discribe_illness='$new_discribe_illness', 
    bu_taking_any_medicine='$new_taking_any_medicine', bu_discribe_medicine='$new_discribe_medicine', 
    bu_undergone_any_surgery='$new_undergone_any_surgery', bu_discribe_surgery='$new_discribe_surgery' WHERE bu_id='" . $user['bu_id'] . "';");

    // Set a session variable for success message
    $_SESSION['success_message'] = 'Profile updated successfully';

    // Redirect back to the profile page
    header("Location: logged.php?id=" . $user['bu_id']);
    exit();
}
?>
